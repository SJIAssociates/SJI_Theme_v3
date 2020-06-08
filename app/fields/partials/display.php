<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$TabDisplay = new FieldsBuilder('Display');

$TabDisplay
    ->addTab('Display', ['placement' => 'left'])
      ->addButtonGroup('section_height', [ 'label' => 'Section Height'])
        ->addChoices(['auto' => 'Auto'], ['min-h-screen' => 'Full Screen'], ['h-custom' => 'Custom'])
        ->setDefaultValue('auto')
        ->setWrapper(['width' => '33', 'class' => 'field', 'id' => 'field'])

        ->addButtonGroup('header_location')
          ->setLabel('Header Location')
          ->addChoices(['' => 'Top'], ['flex flex-wrap justify' => 'Middle'], ['flex flex-col-reverse' => 'Bottom'])
          ->setDefaultValue('')

        ->addButtonGroup('padding_setting', [ 'label' => 'Padding Style'])
          ->addChoices(['py-5 lg:py-10' => 'Normal'], ['py-0' => 'None'])
          ->setDefaultValue('normal');

return $TabDisplay;
