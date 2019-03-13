<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ReactAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
  		YII_ENV_DEV ? 'https://unpkg.com/react@16/umd/react.development.js' : 'https://unpkg.com/react@16/umd/react.production.min.js',
      YII_ENV_DEV ? 'https://unpkg.com/react-dom@16/umd/react-dom.development.js' : 'https://unpkg.com/react-dom@16/umd/react-dom.production.min.js',
      YII_ENV_DEV ? 'https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.js' : 'https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js',
    ];
    public $jsOptions = ['crossorigin' => true];
    public $depends = [
      'frontend\assets\AppAsset',
      // 'frontend\assets\ReactComponentsAsset',
    ];
}
?>
