<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s pb-10">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="text-center text-primary">',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer Left', 'sage'),
        'id'            => 'footer_left'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer Middle', 'sage'),
        'id'            => 'footer_middle'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer Right', 'sage'),
        'id'            => 'footer_right'
    ] + $config);
});


/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });



});

// -------------------------------------------------------------
// VCard
// -------------------------------------------------------------

class Roots_Vcard_Widget extends \WP_Widget {
  private $fields = array(
    'title'          => 'Title (optional)',
    'street_address' => 'Street Address',
    'locality'       => 'City/Locality',
    'region'         => 'State/Region',
    'postal_code'    => 'Zipcode/Postal Code',
    'tel'            => 'Telephone',
    'email'          => 'Email'
  );

  function __construct() {
    $widget_ops = array('classname' => 'widget_roots_vcard', 'description' => __('Use this widget to add a vCard', 'roots'));

    parent::__construct('widget_roots_vcard', __('Roots: vCard', 'roots'), $widget_ops);
    $this->alt_option_name = 'widget_roots_vcard';

    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  }

  function widget($args, $instance) {
    $cache = wp_cache_get('widget_roots_vcard', 'widget');

    if (!is_array($cache)) {
      $cache = array();
    }

    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }

    if (isset($cache[$args['widget_id']])) {
      echo $cache[$args['widget_id']];
      return;
    }

    ob_start();
    extract($args, EXTR_SKIP);

    $title = apply_filters('widget_title', empty($instance['title']) ? __('vCard', 'roots') : $instance['title'], $instance, $this->id_base);

    foreach($this->fields as $name => $label) {
      if (!isset($instance[$name])) { $instance[$name] = ''; }
    }

    echo $before_widget;

    if ($title) {
      //echo $before_title, $title, $after_title;
    }
  ?>
    <p class="vcard">
      <a class="fn org url font-bold" href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a><br>
      <span class="adr">
        <span class="street-address"><?php echo $instance['street_address']; ?></span><br>
        <span class="locality"><?php echo $instance['locality']; ?></span>,
        <span class="region"><?php echo $instance['region']; ?></span>
        <span class="postal-code"><?php echo $instance['postal_code']; ?></span><br>
      </span>
      <br>
      <span class="email "><a  href="mailto:<?php echo $instance['email']; ?>" class='text-black'/>Email: <?php echo $instance['email']; ?></a></span><br>
      <span class="tel">Phone: <span class="value"><?php echo $instance['tel']; ?></span></span>

    </p>
          <br>
  <?php
    echo $after_widget;

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_roots_vcard', $cache, 'widget');
  }

  function update($new_instance, $old_instance) {
    $instance = array_map('strip_tags', $new_instance);

    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');

    if (isset($alloptions['widget_roots_vcard'])) {
      delete_option('widget_roots_vcard');
    }

    return $instance;
  }

  function flush_widget_cache() {
    wp_cache_delete('widget_roots_vcard', 'widget');
  }

  function form($instance) {
    foreach($this->fields as $name => $label) {
      ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'roots'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
    </p>
    <?php
    }
  }
}
// -------------------------------------------------------------
// VCard
// -------------------------------------------------------------
function register_Roots_Vcard_Widget() {
	register_widget( __NAMESPACE__ . '\\Roots_Vcard_Widget' );
}
add_action('widgets_init', __NAMESPACE__ . '\\register_Roots_Vcard_Widget');

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});
// -------------------------------------------------------------
// Remove Comments
// -------------------------------------------------------------
function custom_menu_page_removing() {
  remove_menu_page( 'edit-comments.php' );          //Comments
}
add_action( 'admin_menu', __NAMESPACE__ .'\\custom_menu_page_removing' );
// -------------------------------------------------------------
// Fix Titles for Archives
// -------------------------------------------------------------
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }

    return $title;

});
// -------------------------------------------------------------
// is_tree function
// Based on http://css-tricks.com/snippets/wordpress/if-page-is-parent-or-child/
// -------------------------------------------------------------
function is_tree($pid) {      // $pid = The ID of the page we're looking for pages underneath
	global $post;         // load details about this page
	$ancestors = get_post_ancestors($post);
	if(is_page()&&($post->post_parent==$pid||is_page($pid)||in_array($pid,$ancestors)))
               return true;   // we're at the page or at a sub page
	else
               return false;  // we're elsewhere
};
// -------------------------------------------------------------
// Removes or edits the 'Protected:' part from posts titles
// -------------------------------------------------------------
function remove_protected_text() {
  return __('%s');
}
add_filter( 'protected_title_format',  __NAMESPACE__ .'\\remove_protected_text' );

add_filter('init', function () {
    if (is_admin()) {
        return;
    }
    wp_deregister_script( 'jquery-core' );
    wp_register_script( 'jquery-core', "https://code.jquery.com/jquery-3.5.1.min.js", array(), '3.1.1' );
    wp_deregister_script( 'jquery-migrate' );
    wp_register_script( 'jquery-migrate', "https://code.jquery.com/jquery-migrate-3.0.0.min.js", array(), '3.0.0' );
});
// -------------------------------------------------------------
// Front Page Scripts Cleanup
// -------------------------------------------------------------
function script_cleanup() {

  if(is_front_page()  ) {
    //Enter Scripts Here.

    //Events Calendar
    //wp_dequeue_script('tribe-common');
    //wp_dequeue_script('tribe-tooltip-js');

    //Contact Form 7 (not needed if no form is on the homepage)
    //wp_dequeue_script('contact-form-7');

  }

}
add_action('wp_footer', __NAMESPACE__ .'\\script_cleanup');
// -------------------------------------------------------------
// Front Page Style Cleanup
// -------------------------------------------------------------
function style_cleanup() {
  if(is_front_page()  ) {

    //Contact Form 7
    //wp_dequeue_style('contact-form-7');


    //Events
    //wp_dequeue_style('tribe-tooltip');
    //wp_dequeue_style('tribe-events-admin-menu');

    //Simple Lightbox
    //wp_dequeue_style('slb_core');

  }
  //This is how you dequeue scripts on a speciic Page
  // if(basename(get_page_template()) == "template-form.blade.php") {
  //
  // }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ .'\\style_cleanup',100);

// -------------------------------------------------------------
// Front Page Style Cleanup
// -------------------------------------------------------------
function remove_roots_share_buttons_assets() {
  wp_dequeue_style('roots-share-buttons');
}
add_action('wp_enqueue_scripts',  __NAMESPACE__ .'\\remove_roots_share_buttons_assets');


// -------------------------------------------------------------
//  Initialize ACF Builder
// -------------------------------------------------------------

add_action('init', function () {
    collect(glob(config('theme.dir').'/app/fields/*.php'))->map(function ($field) {
        return require_once($field);
    })->map(function ($field) {
        if ($field instanceof FieldsBuilder) {
            acf_add_local_field_group($field->build());
        }
    });
});
// -------------------------------------------------------------
// ACF Options Page
// -------------------------------------------------------------
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}
