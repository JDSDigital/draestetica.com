<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class NivoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
  		'vendor/nivo-lightbox/css/nivo-lightbox.css',
  		'vendor/nivo-lightbox/themes/default/default.css',
      'vendor/nivo-slider/themes/default/default.css',
  		'vendor/nivo-slider/themes/light/light.css',
  		'vendor/nivo-slider/themes/dark/dark.css',
  		'vendor/nivo-slider/themes/bar/bar.css',
  		'vendor/nivo-slider/css/nivo-slider.css',
    ];
    public $js = [
  		'vendor/nivo-lightbox/js/nivo-lightbox.min.js',
      'vendor/nivo-slider/js/jquery.nivo.slider.js',
    ];
    public $depends = [
      'frontend\assets\AppAsset',
    ];
}
?>
