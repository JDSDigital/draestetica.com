<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\BlogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tag_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'summary') ?>

    <?= $form->field($model, 'article') ?>

    <?php // echo $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'featured') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
