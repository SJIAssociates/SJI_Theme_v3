<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$Tabcontent = new FieldsBuilder('content');

$Tabcontent
    ->addTab('Content', ['placement' => 'left'])
      ->addText('section_header', ['label' => 'Section Header'])
          ->setInstructions('Enter the section header. This will be output in an H2 Tag')

      ->addWysiwyg('section_content', [
          'label' => 'Section Content',
          'tabs' => 'all',
          'toolbar' => 'full',
          'media_upload' => 1,
      ]);

return $Tabcontent;
