<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ClinicServices */

$this->title = 'Crear Servicio';
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-lg-12">
    <section class="panel ml10 mr10 p20">

      <?= $this->render('_form', [
        'model' => $model,
      ]) ?>

    </section>
  </div>
</div>
