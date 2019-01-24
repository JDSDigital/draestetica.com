<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class CKEditorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        'js/plugins/editors/ckeditor/ckeditor.js',
        'js/demo_pages/editor_ckeditor.js',
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
