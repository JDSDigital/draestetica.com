<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Sweet Alert files.
 */
class SweetAlertAsset extends AssetBundle
{
	public $sourcePath = '@bower/sweetalert2/dist';
	public $css = [
		YII_ENV_DEV ? 'sweetalert2.css' : 'sweetalert2.min.css',
	];
	public $js = [
		YII_ENV_DEV ? 'sweetalert2.all.js' : 'sweetalert2.all.min.js',
	];
}
