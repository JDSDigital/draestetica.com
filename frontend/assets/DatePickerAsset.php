<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class DatePickerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'vendor/jquery-ui/themes/base/jquery-ui.min.css',
    ];
    public $js = [
      'vendor/jquery/jquery.min.js',
      'vendor/jquery-ui/ui/widget.js',
      'vendor/jquery-ui/ui/version.js',
      'vendor/jquery-ui/ui/keycode.js',
      'vendor/jquery-ui/ui/position.js',
      'vendor/jquery-ui/ui/unique-id.js',
      'vendor/jquery-ui/ui/safe-active-element.js',
      'vendor/jquery-ui/ui/widgets/menu.js',
      'vendor/jquery-ui/ui/widgets/mouse.js',
      'vendor/jquery-ui/ui/widgets/datepicker.js',
      'js/components/hs.datepicker.js',
      'js/datepicker.js',
    ];
    public $depends = [
        'frontend\assets\ThemeAsset',
    ];
}
