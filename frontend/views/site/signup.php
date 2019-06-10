<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\DatePickerAsset;

DatePickerAsset::register($this);

$this->title = 'Registro';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="clearfix">
      <div class="row no-gutters align-items-center">
        <div class="col-lg-6">
          <!-- Promo Block - Slider -->
            <?= Html::img('@web/img/bg/login.jpg', ['class' => 'img-fluid']) ?>
          <!-- End Promo Block - Slider -->
        </div>

        <div class="col-lg-6">
          <div class="g-pa-50 g-pb-0 g-mx-70--xl">
            <!-- Form -->
            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
                // 'options' => ['class' => 'g-py-15']
            ]); ?>
              <h2 class="h3 g-color-black mb-4"><?= $this->title ?></h2>

              <div class="mb-4">
                <?= $form->field($model, 'name', [
                    'template' => '<div class="input-group g-brd-primary--focus">'
                    .'<span class="input-group-addon g-width-45 g-brd-gray-light-v4 g-color-primary">'
                        .'<i class="icon-finance-067 u-line-icon-pro"></i>'
                      .'</span>'
                      .'{input}'
                  .'</div>'
                ])->textInput([
                    'class' => 'form-control g-color-black g-brd-left-none g-bg-white g-brd-gray-light-v4 g-pl-0 g-pr-15 g-py-15',
                    'placeholder' => 'Nombre',
                ]) ?>
              </div>

              <div class="mb-4">
                <?= $form->field($model, 'lastname', [
                    'template' => '<div class="input-group g-brd-primary--focus">'
                    .'<span class="input-group-addon g-width-45 g-brd-gray-light-v4 g-color-primary">'
                        .'<i class="icon-finance-067 u-line-icon-pro"></i>'
                      .'</span>'
                      .'{input}'
                  .'</div>'
                ])->textInput([
                    'class' => 'form-control g-color-black g-brd-left-none g-bg-white g-brd-gray-light-v4 g-pl-0 g-pr-15 g-py-15',
                    'placeholder' => 'Apellido',
                ]) ?>
              </div>

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
                <?= $form->field($model, 'rut', [
                    'template' => '<div class="input-group g-brd-primary--focus">'
                    .'<span class="input-group-addon g-width-45 g-brd-gray-light-v4 g-color-primary">'
                        .'<i class="icon-finance-067 u-line-icon-pro"></i>'
                      .'</span>'
                      .'{input}'
                  .'</div>'
                ])->textInput([
                    'class' => 'form-control g-color-black g-brd-left-none g-bg-white g-brd-gray-light-v4 g-pl-0 g-pr-15 g-py-15',
                    'placeholder' => 'RUT',
                ]) ?>
              </div>

              <div class="mb-4">
                <?= $form->field($model, 'birthday', [
                    'template' => '<div class="input-group g-brd-primary--focus">'
                    .'<span class="input-group-addon g-width-45 g-brd-gray-light-v4 g-color-primary">'
                        .'<i class="icon-calendar u-line-icon-pro"></i>'
                      .'</span>'
                      .'{input}'
                  .'</div>'
                ])->textInput([
                    'class' => 'form-control g-color-black g-brd-left-none g-bg-white g-brd-gray-light-v4 g-pl-0 g-pr-15 g-py-15',
                    'placeholder' => 'YYYY-MM-DD Fecha de Nacimiento',
                    'data-mask' => '9999-99-99',
                    'value' => ''
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

              <div class="mb-4">
                <?= $form->field($model, 'repassword', [
                    'template' => '<div class="input-group g-brd-primary--focus">'
                        .'<span class="input-group-addon g-width-45 g-brd-gray-light-v4 g-color-primary">'
                        .'<i class="icon-media-094 u-line-icon-pro"></i>'
                        .'</span>'
                    .'{input}'
                    .'</div>'
                ])->passwordInput([
                    'class' => 'form-control g-color-black g-brd-left-none g-bg-white g-brd-gray-light-v4 g-pl-0 g-pr-15 g-py-15',
                    'placeholder' => 'Repetir Contraseña'
                ]) ?>
              </div>

              <div class="g-mb-20">
                <?= Html::submitButton('Registrarse', ['class' => 'btn btn-md btn-block u-btn-primary rounded text-uppercase g-py-13', 'name' => 'login-button']) ?>
              </div>

              <?php ActiveForm::end(); ?>
            <!-- End Form -->
          </div>
        </div>
      </div>
    </section>
    <!-- End Login -->
