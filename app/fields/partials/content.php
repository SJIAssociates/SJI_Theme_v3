<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$Tabcontent = new FieldsBuilder('content');

$Tabcontent
    ->addTab('Content', ['placement' => 'left'])
      ->addText('section_header', ['label' => 'Section Header'])
          ->setInstructions('Enter the section header. This will be output in an H2 Tag')
          ->setWrapper(['width' => '66'])

      ->addButtonGroup('content_type', [ 'label' => 'Editor Type'])
        ->addChoices(['visual' => 'Visual Editor'], ['custom' => 'HTML'])
        ->setDefaultValue('visual')
        ->setWrapper(['width' => '33'])

      ->AddTextarea('custom_code',['label' => 'Custom Code'])
        ->conditional('content_type', '==', 'custom')

      ->addWysiwyg('section_content', [
          'label' => 'Section Content',
          'tabs' => 'all',
          'toolbar' => 'full',
          'media_upload' => 1,
      ])
      ->conditional('content_type', '==', 'visual');



return $Tabcontent;
