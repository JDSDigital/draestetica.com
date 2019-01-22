<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Partners */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partners-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'language' => 'es',
        'pluginOptions' => [
          'previewFileType' => 'image',
          'showCancel' => false,
          'showUpload' => false,
          'showDelete' => true,
          'allowedFileTypes' => ['image'],
          'allowedFileExtensions' => ['jpg', 'png'],
          'maxFileSize' => 2800,
          'maxFileCount' => 9,
          'overwriteInitial' => false,
          'initialPreview' => isset($previews) ? $previews : false,
          'initialPreviewAsData' => true,
          'initialPreviewShowDelete' => true,
          'initialPreviewConfig' => isset($previewsConfig) ? $previewsConfig : false,
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
