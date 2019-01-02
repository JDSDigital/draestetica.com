<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

// Favicon
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '196x196', 'href' => Yii::getAlias('@web') . '/img/favicon/favicon-196x196.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '96x96', 'href' => Yii::getAlias('@web') . '/img/favicon/favicon-96x96.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '32x32', 'href' => Yii::getAlias('@web') . '/img/favicon/favicon-32x32.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '16x16', 'href' => Yii::getAlias('@web') . '/img/favicon/favicon-16x16.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '128x128', 'href' => Yii::getAlias('@web') . '/img/favicon/favicon-128.png']);

$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '57x57', 'href' => Yii::getAlias('@web') . '/img/favicon/apple-touch-icon-57x57.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '114x114', 'href' => Yii::getAlias('@web') . '/img/favicon/apple-touch-icon-114x114.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '72x72', 'href' => Yii::getAlias('@web') . '/img/favicon/apple-touch-icon-72x72.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '144x144', 'href' => Yii::getAlias('@web') . '/img/favicon/apple-touch-icon-144x144.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '60x60', 'href' => Yii::getAlias('@web') . '/img/favicon/apple-touch-icon-60x60.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '120x120', 'href' => Yii::getAlias('@web') . '/img/favicon/apple-touch-icon-120x120.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '76x76', 'href' => Yii::getAlias('@web') . '/img/favicon/apple-touch-icon-76x76.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '152x152', 'href' => Yii::getAlias('@web') . '/img/favicon/apple-touch-icon-152x152.png']);

$this->registerMetaTag(['name' => 'application-name', 'content' => 'Dra. Estética']);
$this->registerMetaTag(['name' => 'msapplication-TileColor', 'content' => '#FFFFFF']);
$this->registerMetaTag(['name' => 'msapplication-TileImage', 'content' => './img/favicon/mstile-144x144.png']);
$this->registerMetaTag(['name' => 'msapplication-square70x70logo', 'content' => './img/favicon/mstile-70x70.png']);
$this->registerMetaTag(['name' => 'msapplication-square150x150logo', 'content' => './img/favicon/mstile-150x150.png']);
$this->registerMetaTag(['name' => 'msapplication-wide310x150logo', 'content' => './img/favicon/mstile-310x150.png']);
$this->registerMetaTag(['name' => 'msapplication-square310x310logo', 'content' => './img/favicon/mstile-310x310.png']);

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="u-body--header-side-overlay-left">
<?php $this->beginBody() ?>

<div class="wrap">

  <!-- Header Toggle Button -->
    <button class="btn u-btn-white u-header-toggler u-header-toggler--top-right g-pa-0" id="header-toggler" aria-haspopup="true" aria-expanded="false" aria-controls="js-header" aria-label="Toggle Header" data-target="#js-header">
      <span class="hamburger hamburger--collapse">
    <span class="hamburger-box">
      <span class="hamburger-inner"></span>
      </span>
      </span>
    </button>
    <!-- End Header Toggle Button -->

    <!-- Sidebar Navigation -->
    <div id="js-header" class="u-header u-header--side" aria-labelledby="header-toggler" data-header-behavior="overlay" data-header-position="left" data-header-breakpoint="lg" data-header-classes="g-transition-0_5" data-header-overlay-classes="g-bg-black-opacity-0_8 g-transition-0_5">
      <div class="u-header__sections-container g-bg-white g-brd-right--lg g-brd-gray-light-v5 g-py-10 g-py-40--lg g-px-14--lg">
        <div class="u-header__section u-header__section--light">
          <nav class="navbar navbar-expand-lg">
            <div class="js-mega-menu container">
              <!-- Responsive Toggle Button -->
              <button class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-right-0" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                <span class="hamburger hamburger--slider">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
                </span>
                </span>
              </button>
              <!-- End Responsive Toggle Button -->
              <!-- Logo -->
                <?=
                Html::a(
                  Html::img('@web/img/logo/logo-nomargin-2.png', ['class' => 'img-responsive']),
                  ['site/index'],
                  ['class' => 'navbar-brand g-mb-20--lg']
                  )
                ?>
              <!-- End Logo -->

              <!-- Navigation -->
              <div class="collapse navbar-collapse align-items-center flex-sm-row w-100 g-mt-20 g-mt-0--lg g-mb-40" id="navBar">
                <ul class="navbar-nav ml-auto text-uppercase g-font-weight-600 u-sub-menu-v1">
                  <li class="nav-item g-my-5">
                    <a href="#" class="nav-link <?= (Yii::$app->controller->id == 'site') ? 'active' : '' ?>">Inicio</a>
                  </li>
                  <li class="nav-item g-my-5">
                    <a href="#" class="nav-link <?= (Yii::$app->controller->id == 'social') ? 'active' : '' ?>">Social</a>
                  </li>
                  <li class="nav-item g-my-5">
                    <a href="#" class="nav-link <?= (Yii::$app->controller->id == 'blog') ? 'active' : '' ?>">Blog</a>
                  </li>
                  <li class="nav-item g-my-5">
                    <a href="#" class="nav-link <?= (Yii::$app->controller->id == 'contacto') ? 'active' : '' ?>">Contacto</a>
                  </li>
                </ul>
              </div>
              <!-- End Navigation -->

            </div>
          </nav>
        </div>
      </div>
    </div>
    <!-- End Sidebar Navigation -->
    <?php /*
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end(); */
    ?>

    <div class="">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<div id="instafeed"></div>

<!-- Footer -->
<footer class="bg-theme-gradient-v1 g-color-white g-py-60">
  <div class="container">
    <div class="row">
      <!-- Footer Content -->
      <div class="col-lg-3 g-mb-40 g-mb-0--lg">
        <a class="d-block g-mb-20" href="#">
          <?= Html::img('@web/img/logo/logo-transparent-nomargin-1.png', ['class' => 'img-fluid g-mb-5']) ?>
        </a>

        <div class="g-mb-20">
          <p>Lorem ipsum dolor sit amet, consec tetur adipiscing elit. Maecenas eget nisl id libero tincidunt.</p>
        </div>

      </div>
      <!-- End Footer Content -->

      <!-- Footer Content -->
      <div class="col-lg-4 g-mb-40 g-mb-0--lg">
        <h2 class="h6 g-color-white text-uppercase g-font-weight-700 g-mb-20">Últimos Posts</h2>
        <article class="media">
          <a class="d-flex g-mt-4 mr-3" href="#">
            <?= Html::img('@web/img-temp/100x100/img8.jpg', ['class' => 'g-width-80 g-height-80']) ?>
          </a>

          <div class="media-body align-self-center">
            <ul class="list-inline g-font-size-12 g-mb-10">
              <li class="list-inline-item">Junio 09, 2018</li>
            </ul>

            <h3 class="h6 mb-0">
              <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">Top 7 luxury places to visit around Victoria, BC</a>
            </h3>
          </div>
        </article>

        <hr class="g-brd-white-opacity-0_1 g-mt-15 g-mb-10">

        <article class="media">
          <a class="d-flex g-mt-4 mr-3" href="#">
            <?= Html::img('@web/img-temp/100x100/img9.jpg', ['class' => 'g-width-80 g-height-80']) ?>
          </a>

          <div class="media-body align-self-center">
            <ul class="list-inline g-font-size-12 g-mb-10">
              <li class="list-inline-item">Julio 30, 2018</li>
            </ul>

            <h3 class="h6 mb-0">
              <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">Coding week, 10 best premium templates</a>
            </h3>
          </div>
        </article>
      </div>
      <!-- End Footer Content -->

      <!-- Footer Content -->
      <div class="col-md-6 col-lg-2 g-mb-30 g-mb-0--lg">
        <h2 class="h6 g-color-white text-uppercase g-font-weight-700 g-mb-20">Navegación</h2>
        <ul class="list-unstyled mb-0">
          <li class="d-flex align-items-baseline g-mb-12">
            <i class="fa fa-angle-double-right g-mr-8"></i>
            <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">Inicio</a>
          </li>
          <li class="d-flex align-items-baseline g-mb-12">
            <i class="fa fa-angle-double-right g-mr-8"></i>
            <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">Social</a>
          </li>
          <li class="d-flex align-items-baseline g-mb-12">
            <i class="fa fa-angle-double-right g-mr-8"></i>
            <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">Blog</a>
          </li>
          <li class="d-flex align-items-baseline g-mb-12">
            <i class="fa fa-angle-double-right g-mr-8"></i>
            <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">Contacto</a>
          </li>
        </ul>
      </div>
      <!-- End Footer Content -->

      <!-- Footer Content -->
      <div class="col-md-6 col-lg-3">
        <h2 class="h6 g-color-white text-uppercase g-font-weight-700 g-mb-20">Últimas fotos</h2>

        <ul class="u-list-inline d-flex flex-wrap g-mr-minus-15">
          <li class="list-inline-item g-mr-10 g-mb-10">
            <a class="u-block-hover" href="#">
              <?= Html::img('@web/img-temp/100x100/img10.jpg', ['class' => 'u-block-hover__main--grayscale g-width-80 g-height-80']) ?>
            </a>
          </li>
          <li class="list-inline-item g-mr-10 g-mb-10">
            <a class="u-block-hover" href="#">
              <?= Html::img('@web/img-temp/100x100/img12.jpg', ['class' => 'u-block-hover__main--grayscale g-width-80 g-height-80']) ?>
            </a>
          </li>
          <li class="list-inline-item g-mr-10 g-mb-10">
            <a class="u-block-hover" href="#">
              <?= Html::img('@web/img-temp/100x100/img13.jpg', ['class' => 'u-block-hover__main--grayscale g-width-80 g-height-80']) ?>
            </a>
          </li>
          <li class="list-inline-item g-mr-10 g-mb-10">
            <a class="u-block-hover" href="#">
              <?= Html::img('@web/img-temp/100x100/img14.jpg', ['class' => 'u-block-hover__main--grayscale g-width-80 g-height-80']) ?>
            </a>
          </li>
          <li class="list-inline-item g-mr-10 g-mb-10">
            <a class="u-block-hover" href="#">
              <?= Html::img('@web/img-temp/100x100/img15.jpg', ['class' => 'u-block-hover__main--grayscale g-width-80 g-height-80']) ?>
            </a>
          </li>
          <li class="list-inline-item g-mr-10 g-mb-10">
            <a class="u-block-hover" href="#">
              <?= Html::img('@web/img-temp/100x100/img16.jpg', ['class' => 'u-block-hover__main--grayscale g-width-80 g-height-80']) ?>
            </a>
          </li>
        </ul>
      </div>
      <!-- End Footer Content -->
    </div>
  </div>
</footer>
<!-- End Footer -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
