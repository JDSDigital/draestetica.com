<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use backend\assets\CKEditorAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Social */
/* @var $form yii\widgets\ActiveForm */
CKEditorAsset::register($this);

$cover = Url::to(['//Social/social/cover?id=']);
$btn = "<button type='button' class='kv-file-cover btn btn-sm btn-kv btn-default btn-outline-secondary' title='Portada' data-url='$cover{key}' data-key='{key}'><i class='glyphicon glyphicon-star'></i></button>";
?>

<div class="social-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'images[]')->widget(FileInput::classname(), [
        'language' => 'es',
        'options' => [
          'multiple' => true,
        ],
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
          'otherActionButtons' => $btn,
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
