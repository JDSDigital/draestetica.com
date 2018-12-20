<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
                  Html::img('@web/img/logo/logo-1.png', ['class' => 'img-responsive']),
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

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
