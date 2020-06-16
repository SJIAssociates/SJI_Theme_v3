<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$config = (object) [
    'ui' => 1,
    'wrapper' => ['width' => 100],
];

$oneColumn = new FieldsBuilder('One Column');

$oneColumn
  ->addGroup('One Column')

    ->addFields(get_field_partial('partials.content'))

    ->addFields(get_field_partial('partials.background'))
    ->addFields(get_field_partial('partials.display')->removeField('header_location')->removeField('header_color'))

  ->endGroup();

return $oneColumn;
