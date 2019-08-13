<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\assets\NivoAsset;

NivoAsset::register($this);

$this->title = $service->name;
$this->params['breadcrumbs'][] = ['label' => 'Clinic', 'url' => ['index']];
$this->params['breadcrumbs'][] = $service->name;
?>
<div class="container g-pt-50 g-pb-100">
  <div class="row">
    <div class="col-lg-4">
      <div class="slider-wrapper theme-default shop-carousel g-mb-30">
          <div id="slider-shop" class="nivoSlider">
            <?php foreach ($service->images as $image) : ?>
              <?= Html::a(Html::img($image->getImage(), ['data-thumb' => $image->getThumb()]), $image->getImage(), ['data-lightbox-gallery'=>'gallery']) ?>
            <?php endforeach; ?>
          </div>
      </div>
    </div>
    <div class="col-lg-8">
      <h2 class="h1 g-mb-15"><?= $service->name ?></h2>
      <?= $service->description ?>
    </div>
  </div>
</div>
