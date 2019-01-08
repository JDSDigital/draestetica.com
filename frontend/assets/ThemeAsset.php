<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ThemeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      '//fonts.googleapis.com/css?family=Open+Sans%3A400%2C300%2C500%2C600%2C700%7CPlayfair+Display%7CRoboto%7CRaleway%7CSpectral%7CRubik',
      'vendor/bootstrap/bootstrap.min.css',
      'vendor/bootstrap/offcanvas.css',
      'vendor/icon-awesome/css/font-awesome.min.css',
      'vendor/icon-line/css/simple-line-icons.css',
      'vendor/icon-etlinefont/style.css',
      'vendor/icon-line-pro/style.css',
      'vendor/icon-hs/style.css',
      'vendor/dzsparallaxer/dzsparallaxer.css',
      'vendor/dzsparallaxer/dzsscroller/scroller.css',
      'vendor/dzsparallaxer/advancedscroller/plugin.css',
      'vendor/animate.css',
      'vendor/hamburgers/hamburgers.min.css',
      'vendor/malihu-scrollbar/jquery.mCustomScrollbar.min.css',
      'vendor/slick-carousel/slick/slick.css',
      'vendor/fancybox/jquery.fancybox.css',

      YII_ENV_DEV ? 'css/unify-core.css' : 'css/unify-core.min.css',
      YII_ENV_DEV ? 'css/unify-components.css' : 'css/unify-components.min.css',
      YII_ENV_DEV ? 'css/unify-globals.css' : 'css/unify-globals.min.css',
      // YII_ENV_DEV ? 'css/unify.css' : 'css/unify.min.css',
      YII_ENV_DEV ? 'css/custom.css' : 'css/custom.min.css',
    ];
    public $js = [
        'vendor/jquery/jquery.min.js',
        'vendor/jquery-migrate/jquery-migrate.min.js',
        'vendor/jquery.easing/js/jquery.easing.js',
        'vendor/popper.min.js',
        'vendor/bootstrap/bootstrap.min.js',
        'vendor/bootstrap/offcanvas.js',

        'vendor/dzsparallaxer/dzsparallaxer.js',
        'vendor/dzsparallaxer/dzsscroller/scroller.js',
        'vendor/dzsparallaxer/advancedscroller/plugin.js',
        'vendor/masonry/dist/masonry.pkgd.min.js',
        'vendor/imagesloaded/imagesloaded.pkgd.min.js',
        'vendor/malihu-scrollbar/jquery.mCustomScrollbar.concat.min.js',
        'vendor/slick-carousel/slick/slick.js',
        'vendor/fancybox/jquery.fancybox.min.js',

        'js/hs.core.js',

        'js/components/hs.header-side.js',
        'js/helpers/hs.hamburgers.js',

        'js/components/hs.dropdown.js',
        'js/components/hs.scrollbar.js',
        'js/components/hs.popup.js',
        'js/components/hs.carousel.js',

        'js/components/hs.sticky-block.js',

        'js/custom.js',
    ];
}
