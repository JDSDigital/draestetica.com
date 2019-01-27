<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Tags;
use kartik\widgets\FileInput;
use backend\assets\CKEditorAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */
/* @var $form yii\widgets\ActiveForm */
CKEditorAsset::register($this);
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tag_id')->dropdownList(Tags::getList()) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article')->textarea(['rows' => 6, 'cols' => 4]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>

    <div class="row">
      <div class="col-md-12">
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
      </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
