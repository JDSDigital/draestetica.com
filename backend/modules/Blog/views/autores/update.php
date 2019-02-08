<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Authors */

$this->title = 'Modificar Autor: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Autores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="row">
  <div class="col-lg-12">
    <section class="panel ml10 mr10 p20">

      <?= $this->render('_form', [
        'model' => $model,
        'previews' => $previews,
        'previewsConfig' => $previewsConfig,
      ]) ?>

    </section>
  </div>
</div>
