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
      'css/main.848829c1.chunk.css',
    ];
    public $js = [
      // YII_ENV_DEV ? 'js/clinic/all.js' : 'js/clinic/all.min.js',
      'js/clinic/2.f58d9d9c.chunk.js',
      'js/clinic/main.d31b8b06.chunk.js',
    ];
    // public $jsOptions = ['type' => 'module'];
    public $depends = [
      // 'frontend\assets\ReactAsset',
    ];
}
?>
