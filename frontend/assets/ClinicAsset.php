<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ClinicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      // YII_ENV_DEV ? 'css/clinic.css' : 'css/clinic.min.css',
    ];
    public $js = [
      // YII_ENV_DEV ? 'js/clinic/all.js' : 'js/clinic/all.min.js',
      'js/clinic/2.f885ce20.chunk.js',
      'js/clinic/main.79c99905.chunk.js',
    ];
    // public $jsOptions = ['type' => 'module'];
    public $depends = [
      // 'frontend\assets\ReactAsset',
    ];
}
?>
