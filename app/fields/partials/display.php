<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$TabDisplay = new FieldsBuilder('Display');

$TabDisplay
    ->addTab('Display', ['placement' => 'left'])
      ->addButtonGroup('section_height', [ 'label' => 'Section Height'])
        ->addChoices(['auto' => 'Auto'], ['min-h-screen' => 'Full Screen'], ['h-custom' => 'Custom'])
        ->setDefaultValue('auto')

        ->addButtonGroup('header_location')
          ->setLabel('Header Location')
          ->addChoices(['' => 'Top'], ['flex flex-wrap content-center text-center' => 'Middle'], ['flex flex-col-reverse' => 'Bottom'])
          ->setDefaultValue('')
          ->setWidth('50%')

        ->addColorPicker('header_color', ['label' => 'Header Color'])
          ->setWidth('50%')

        ->addButtonGroup('padding_top', [ 'label' => 'Padding Top'])
          ->addChoices(['' => 'Normal'], ['pt-0 lg:pt-0' => 'None'])
          ->setDefaultValue('')
          ->setWidth('50%')

        ->addButtonGroup('padding_bottom', [ 'label' => 'Padding Bottom'])
          ->addChoices(['' => 'Normal'], ['pb-0 lg:pb-0' => 'None'])
          ->setDefaultValue('')
          ->setWidth('50%');

return $TabDisplay;
