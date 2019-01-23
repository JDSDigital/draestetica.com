<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
      <div class="col-md-6">
        <?= $form->field($model, 'email')->textInput() ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <?= $form->field($model, 'password')->passwordInput() ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <?= $form->field($model, 'repassword')->passwordInput() ?>
      </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
