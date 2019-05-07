<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Clients */

$this->title = 'Nuevo Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
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
