<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$themeOption_Logo = new FieldsBuilder('Logo');

$themeOption_Logo
    ->setLocation('options_page', '==', 'theme-general-settings')
      ->setGroupConfig('position', 'side');

$themeOption_Logo
  ->AddImage('logo',[ 'label' => 'Logo']);

return $themeOption_Logo;
