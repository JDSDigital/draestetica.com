<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Login -->
<section class="clearfix">
      <div class="row no-gutters align-items-center">
        <div class="col-lg-6">
          <!-- Promo Block - Slider -->
            <?= Html::img('@web/img/bg/login.jpg', ['class' => 'img-fluid']) ?>
          <!-- End Promo Block - Slider -->
        </div>

        <div class="col-lg-6">
          <div class="g-pa-50 g-mx-70--xl">
            <!-- Form -->
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'g-py-15']
            ]); ?>
              <h2 class="h3 g-color-black mb-4">Iniciar Sesión</h2>

              <div class="mb-4">
                <?= $form->field($model, 'email', [
                    'template' => '<div class="input-group g-brd-primary--focus">'
                    .'<span class="input-group-addon g-width-45 g-brd-gray-light-v4 g-color-primary">'
                        .'<i class="icon-finance-067 u-line-icon-pro"></i>'
                      .'</span>'
                      .'{input}'
                  .'</div>'
                ])->textInput([
                    'class' => 'form-control g-color-black g-brd-left-none g-bg-white g-brd-gray-light-v4 g-pl-0 g-pr-15 g-py-15',
                    'placeholder' => 'Correo',
                ]) ?>
              </div>

              <div class="mb-4">
                <?= $form->field($model, 'password', [
                    'template' => '<div class="input-group g-brd-primary--focus">'
                        .'<span class="input-group-addon g-width-45 g-brd-gray-light-v4 g-color-primary">'
                        .'<i class="icon-media-094 u-line-icon-pro"></i>'
                        .'</span>'
                    .'{input}'
                    .'</div>'
                ])->passwordInput([
                    'class' => 'form-control g-color-black g-brd-left-none g-bg-white g-brd-gray-light-v4 g-pl-0 g-pr-15 g-py-15',
                    'placeholder' => 'Contraseña'
                ]) ?>
              </div>

              <div class="row justify-content-between mb-4">
                <div class="col align-self-center text-center">
                  <?= Html::a('¿Olvidaste tu contraseña?', 
                    ['//site/request-password-reset'], 
                    ['class' => 'g-color-gray-dark-v4 g-color-primary--hover'])
                  ?>
                </div>
              </div>

              <div class="g-mb-50">
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-md btn-block u-btn-primary rounded text-uppercase g-py-13', 'name' => 'login-button']) ?>
              </div>

              <p class="g-font-size-13 text-center mb-0">¿No tienes una cuenta? <?= Html::a('¡Regístrate!', ['//site/signup'], ['class' => 'g-font-weight-600']) ?>
              </p>
              <?php ActiveForm::end(); ?>
            <!-- End Form -->
          </div>
        </div>
      </div>
    </section>
    <!-- End Login -->
