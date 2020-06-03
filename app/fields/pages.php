<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$page = new FieldsBuilder('page');

$page
    ->setLocation('post_type', '==', 'page');

$page
    ->addFields(get_field_partial('partials.general'))
        ->removeField('enable_featured_image')

    ->addFields(get_field_partial('partials.header'));

return $page;
