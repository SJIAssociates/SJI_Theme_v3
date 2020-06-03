<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$themeOption_Social = new FieldsBuilder('Social Media');

$themeOption_Social
    ->setLocation('options_page', '==', 'theme-general-settings')
      ->setGroupConfig('position', 'side');

$themeOption_Social
  ->addUrl('facebook', [ 'label' => 'Facebook Page'])

  ->addUrl('twitter', ['label' => 'Twitter Profile'])

  ->addUrl('youtube', ['label' => 'Youtube Page'])

  ->addUrl('instagram', ['label' => 'Instgram Page']);

return $themeOption_Social;
