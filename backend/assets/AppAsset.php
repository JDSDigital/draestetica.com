<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/master.css',
        'https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900',
        'css/icons/icomoon/styles.css',
        'css/icons/fontawesome/styles.min.css',
        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
        YII_ENV_DEV ? 'css/core.css' : 'css/core.min.css',
        YII_ENV_DEV ? 'css/components.css' : 'css/components.min.css',
        YII_ENV_DEV ? 'css/colors.css' : 'css/colors.min.css',
    ];
    public $js = [
        // 'https://www.google.com/jsapi',
        'js/yii/yii_overrides.js',
        'js/plugins/loaders/pace.min.js',
        'js/core/libraries/bootstrap.min.js',
        'js/yii/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
