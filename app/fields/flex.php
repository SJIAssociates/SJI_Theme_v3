<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$flex = new FieldsBuilder('page',[
    'style' => 'seamless',
    'hide_on_screen' => ['the_content']]);

$flex
    ->setLocation('post_template', '==', 'views/template-about.blade.php');

$flex
  ->addFlexibleContent('sections', ['about_flex_generator' => 'Sections'])
    ->addLayout(get_field_partial('views/columnOne'))

    ->addLayout(get_field_partial('views/columnTwo'))
    ->addLayout(get_field_partial('views/header'));

return $flex;
