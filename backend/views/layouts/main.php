<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\assets\SweetAlertAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use backend\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
SweetAlertAsset::register($this);
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
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);
    $menuItems = [
        // ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->email . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="page-container">
        <div class="page-content">

            <?php if (!Yii::$app->user->isGuest) : ?>
                <!-- Main sidebar -->
                <div class="sidebar sidebar-main sidebar-default">
                    <div class="sidebar-content">

                        <!-- User menu -->
                        <div class="sidebar-user-material">
                            <div class="category-content">
                                <div class="sidebar-user-material-content">
                                    <a class="legitRipple">
                                        <?= Html::img(Yii::getAlias('@web') . '/images/geknology-white.png', ['class' => 'img-circle img-responsive']) ?>
                                    </a>
                                    <h6>Geknology</h6>
                                    <span class="text-size-small">Techno Services</span>
                                </div>
                            </div>
                        </div>
                        <!-- /user menu -->

                        <!-- Main navigation -->
                        <div class="sidebar-category sidebar-category-visible">
                            <div class="category-content no-padding">
                                <ul class="navigation navigation-main navigation-accordion">

                                    <!-- Main -->
                                    <li class="navigation-header">
                                        <span>Main</span> <i class="icon-menu" title="Main pages"></i>
                                    </li>
                                    <li class="<?= (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') ? 'active' : '' ?>">
                                        <?= Html::a('<i class="icon-home4"></i> <span>Dashboard</span>', ['//site/index']) ?>
                                    </li>
                                    <li class="<?= (Yii::$app->controller->module->id == 'Usuarios') ? 'active' : '' ?>">
                                        <?= Html::a('<i class="icon-users"></i> <span>Usuarios</span>', ['//Usuarios']) ?>
                                    </li>
                                    <li class="<?= (Yii::$app->controller->module->id == 'Social') ? 'active' : '' ?>">
                                        <?= Html::a('<i class="icon-newspaper"></i> <span>Social</span>', ['//Social']) ?>
                                    </li>
                                    <li class="<?= (Yii::$app->controller->module->id == 'Blog') ? 'active' : '' ?>">
                                        <?= Html::a('<i class="icon-reading"></i> <span>Blog</span>') ?>
                                        <ul>
                                            <li>
                                                <?= Html::a('<i class="icon-price-tags"></i> <span>Tags</span>', ['//Blog/tags'], ['class' => (Yii::$app->controller->id == 'tags') ? 'active' : '']) ?>
                                            </li>
                                            <li>
                                                <?= Html::a('<i class="icon-magazine"></i> <span>Blog</span>', ['//Blog/blog'], ['class' => (Yii::$app->controller->id == 'blog') ? 'active' : '']) ?>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="<?= (Yii::$app->controller->module->id == 'Partners') ? 'active' : '' ?>">
                                        <?= Html::a('<i class="icon-store"></i> <span>Partners</span>', ['//Partners']) ?>
                                    </li>
                                    <!-- /Main -->
                                </ul>
                            </div>
                        </div>
                        <!-- /main navigation -->

                    </div>
                </div>
                <!-- /main sidebar -->
            <?php endif; ?>

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
