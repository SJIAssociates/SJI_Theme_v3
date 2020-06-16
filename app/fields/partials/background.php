<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$background = new FieldsBuilder('background');

$background
    ->addTab('Background', ['placement' => 'left'])
      ->addColorPicker('background_color', ['label' => 'Background Color'])

      ->addImage('background_image', [
          'label' => 'Background Image',
          'return_format' => 'array',
          'preview_size' => 'thumbnail',
      ])
      ->setWrapper(['width' => '50'])

      ->addButtonGroup('background_image_size', [
        'label' => 'Background Image Size',
        'choices' => ['contain','cover'],
        'allow_null' => 0,
        'layout' => 'horizontal',
        'return_format' => 'value',
    ])->setWrapper(['width' => '50']);

return $background;
