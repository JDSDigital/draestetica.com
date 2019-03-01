<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Clinic';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
  <div class="container g-pt-70 g-pb-20">
    <div class="row justify-content-between">
      <?php if ($models) : ?>
        <?php foreach ($models as $category => $subcategories) : ?>
          <div class="col-lg-12">
            <div class="u-heading-v1-4 g-bg-main g-brd-gray-light-v2">
              <h2 class="h3 u-heading-v1__title"><?= $category ?></h2>
            </div>
          </div>
          <?php foreach ($subcategories as $subcategory => $services) : ?>
            <div class="col-lg-12">
              <div class="u-heading-v2-3--bottom g-my-30">
                <h4 class="g-font-weight-200 g-mb-10"><?= $subcategory ?></h4>
              </div>
            </div>
            <?php foreach ($services as $service) : ?>
              <div class="col-lg-3">
                <article class="u-shadow-v11 service-container mb-4">
                  <?= Html::a(Html::img($service->getThumb(), ['class' => 'img-fluid w-100 g-rounded-top-5 crop-clinic']), ['clinic/view', 'id' => $service->id]) ?>
                  <div class="g-bg-white g-pa-30 g-rounded-bottom-5">

                    <h2 class="h5 g-color-black g-font-weight-600 mb-4">
                      <?= Html::a($service->name, ['clinic/view', 'id' => $service->id], ['class' => 'u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer']) ?>
                    </h2>

                    <p class="g-font-size-14 g-line-height-2 mb-0">
                      <?= $service->summary ?>
                    </p>

                  </div>
                </article>
              </div>
            <?php endforeach; ?>
          <?php endforeach; ?>
        <?php endforeach; ?>
      <?php else : ?>
        <h3 class="h5 g-color-black g-font-weight-600 g-mb-30">No hay servicios que mostrar</h3>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php $this->registerJs('$(".service-container").SameHeight();') ?>
