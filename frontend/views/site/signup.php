<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Crear Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'lastname') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'rut') ?>
                <?= $form->field($model, 'birthday') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'repassword')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Crear usuario', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
