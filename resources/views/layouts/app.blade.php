<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class('bg-grey-lightest') @endphp>
    <div class="sitewrapper">
      @php do_action('get_header') @endphp

      @include('partials.header')

      <div class='wrap' role='document'>
        @yield('content')

        @php do_action('get_footer') @endphp
        @include('partials.footer')
      </div>
    </div>
    <section id="mega-nav" class="p-12 animate__animated animate__fast">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav text-right mt-12 lg:mt-16']) !!}
      @endif
    </section>
    @php wp_footer() @endphp
  </body>
</html>
