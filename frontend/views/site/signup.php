<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use frontend\assets\DatePickerAsset;

DatePickerAsset::register($this);

$this->title = 'Crear Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'form-signup',
        'options' => ['class' => 'g-brd-around g-brd-gray-light-v4 g-pa-30 g-mb-30']
    ]); ?>
    <!-- Select Single Date -->
  <div class="form-group g-mb-30">
    <label class="g-mb-10">Select single date</label>
    <div class="input-group g-brd-primary--focus">
      <input id="datepickerDefault" class="form-control form-control-md u-datepicker-v1 g-brd-right-none rounded-0" type="text">
      <div class="input-group-addon d-flex align-items-center g-bg-white g-color-gray-dark-v5 rounded-0">
        <i class="icon-calendar"></i>
      </div>
    </div>
  </div>
  <!-- End Select Single Date -->
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'name', [
                        'template' => '{label}'
                        .'<div class="input-group g-brd-primary--focus">'
                        .'<div class="input-group-addon d-flex align-items-center g-bg-white g-color-gray-light-v1 rounded-0">'
                        .'<i class="icon-user-follow"></i>'
                        .'</div>'
                        .'{input}'
                        .'</div>'
                    ])->textInput([
                    'autofocus' => true,
                    'class' => 'form-control form-control-md border-left-0 rounded-0',
                ]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'lastname') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'email') ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'rut') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'birthday')->widget(DatePicker::classname(), [
                    'language' => 'es',
                    'options' => ['placeholder' => 'YYYY-MM-DD'],
                    'value' => '2000/01/01',
                    'removeButton' => false,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'repassword')->passwordInput() ?>
            </div>
        </div>



                <div class="form-group">
                    <?= Html::submitButton('Crear usuario', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            
    <?php ActiveForm::end(); ?>
</div>
