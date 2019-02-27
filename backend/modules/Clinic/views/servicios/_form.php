<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ClinicServicesCategories;
use common\models\ClinicServicesSubcategories;
use kartik\widgets\FileInput;
use backend\assets\CKEditorAsset;

/* @var $this yii\web\View */
/* @var $model common\models\ClinicServices */
/* @var $form yii\widgets\ActiveForm */
CKEditorAsset::register($this);
?>

<div class="clinic-services-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-lg-6">
        <?= $form->field($model, 'category_id')->dropdownList(ClinicServicesCategories::getList()) ?>
      </div>
      <div class="col-lg-6">
        <?= $form->field($model, 'subcategory_id')->dropdownList(ClinicServicesSubcategories::getList()) ?>
      </div>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'cols' => 4]) ?>

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
