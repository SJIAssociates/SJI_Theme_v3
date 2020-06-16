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
    ->addFields(get_field_partial('partials.display')->removeField('header_location')->removeField('header_color'))
      ->addButtonGroup('column_widths')
        ->setLabel('Column Widths')
        ->addChoices(['1' => '25/75'], ['2' => '33/66'],['3' => '50/50'],['4' => '66/33'],['5' => '75/25'])
        ->setDefaultValue('3')
        ->setWidth('100%')

  ->endGroup();

return $TwoColumn;
