<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Clients */

$this->title = 'Actualizar Cliente: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
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
