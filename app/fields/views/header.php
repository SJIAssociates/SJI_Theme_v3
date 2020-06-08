<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$header = new FieldsBuilder('Header');

$header
  ->addGroup('Header')

    ->addFields(get_field_partial('partials.content')->removeField('section_content'))


    ->addFields(get_field_partial('partials.background'))
    ->addFields(get_field_partial('partials.display'))



  ->endGroup();

return $header;
