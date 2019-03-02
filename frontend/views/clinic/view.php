<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $service->name;
$this->params['breadcrumbs'][] = ['label' => 'Clinic', 'url' => ['index']];
$this->params['breadcrumbs'][] = $service->name;
?>
<div class="container g-pt-50 g-pb-100">
  <div class="row">
    <div class="col-lg-4">
      <?= Html::img($service->getImage(), ['class' => 'img-fluid']) ?>
    </div>
    <div class="col-lg-8">
      <h2 class="h1 g-mb-15"><?= $service->name ?></h2>
      <?= $service->description ?>
    </div>
  </div>
</div>
