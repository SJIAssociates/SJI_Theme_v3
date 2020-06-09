<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$TwoColumn = new FieldsBuilder('Two Columns');

$TwoColumn
  ->addGroup('Two Columns')

    ->addFields(get_field_partial('partials.content'))
      ->addWysiwyg('right_column')
        ->setLabel('Right Column')

    ->addFields(get_field_partial('partials.background'))
    ->addFields(get_field_partial('partials.display')->removeField('header_location'))

  ->endGroup();

return $TwoColumn;
