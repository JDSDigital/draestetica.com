<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Instagram;

$this->title = 'Social';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Blog Minimal Blocks -->
<div class="container g-pt-30 g-pb-20">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <!-- Search -->
      <?php
          $form = ActiveForm::begin([
            'id' => 'social-search',
            'action' => ['/social/index']
          ]);
      ?>
      <div class="g-mb-50">
        <!-- <h3 class="h5 g-color-black g-font-weight-600 mb-4">Buscar</h3> -->
        <div class="input-group">
          <input type="text" id="socialsearch-title" class="form-control g-brd-secondary-opacity-0_3 g-placeholder-gray-dark-v5 border-right-0 g-rounded-left-50 g-px-15" name="SocialSearch[title]" placeholder="Buscar...">
          <span class="input-group-btn">
            <?= Html::submitButton('<i class="icon-magnifier g-pos-rel g-top-1"></i>', [
                'class' => 'btn u-btn-gradient-theme-v1 g-rounded-right-50 g-py-13 g-px-20 border-0',
            ]) ?>
          </span>
        </div>
      </div>
      <?php ActiveForm::end(); ?>
      <!-- End Search -->
    </div>
  </div>
  <div class="row justify-content-between">
    <div class="col-lg-9 g-mb-80">
      <div class="g-pr-20--lg">
        <?php if ($dataProvider->getModels()) : ?>
          <?php foreach ($dataProvider->getModels() as $key => $article) : ?>
             <?php if ($article->featured == 1) : ?>
               <!-- Blog Minimal Blocks -->
               <article class="g-mx-15 u-block-hover">
                 <div class="g-px-100--md g-py-30--md">
                   <ul class="list-inline g-color-gray-dark-v4 g-font-weight-600 g-font-size-12">
                     <li class="list-inline-item"><?= Yii::$app->formatter->asDate($article->created_at, 'long') ?></li>
                   </ul>
                   <h2 class="h2 g-color-black g-font-weight-600 mb-4">
                     <?= Html::a($article->title, ['social/view', 'id' => $article->id], ['class' => 'u-link-v5 g-color-black g-color-primary--hover']) ?>
                   </h2>
                 </div>
                 <div class="g-overflow-hidden">
                   <?= Html::img($article->cover->getImage(), ['class' => 'img-fluid w-100 u-block-hover__main--mover-down crop', 'alt' => $article->title]) ?>
                 </div>
                 <div class="g-px-100--md g-py-30--md">
                   <div class="mb-4">
                     <p class="g-font-size-18 g-line-height-2 mb-0"><?= $article->summary ?></p>
                   </div>
                   <?= Html::a('Ver más', ['social/view', 'id' => $article->id], ['class' => 'g-color-gray-dark-v2 g-color-primary--hover g-font-weight-600 g-font-size-12 g-text-underline--none--hover text-uppercase']) ?>
                 </div>
               </article>
               <!-- End Blog Minimal Blocks -->
             <?php else : ?>
               <!-- Blog Minimal Blocks -->
               <article class="row align-items-center u-block-hover">
                 <div class="col-md-6 g-mb-30">
                   <div class="g-overflow-hidden">
                     <?= Html::img($article->cover->getImage(), ['class' => 'img-fluid w-100 u-block-hover__main--mover-down g-mb-minus-6', 'alt' => $article->title]) ?>
                   </div>
                 </div>
                 <div class="col-md-6 g-mb-30">
                   <div class="g-pa-30--md">
                     <ul class="list-inline g-color-gray-dark-v4 g-font-weight-600 g-font-size-12">
                       <li class="list-inline-item"><?= Yii::$app->formatter->asDate($article->created_at, 'long') ?></li>
                     </ul>
                     <h2 class="h3 g-color-black g-font-weight-600 mb-4">
                       <?= Html::a($article->title, ['social/view', 'id' => $article->id], ['class' => 'u-link-v5 g-color-black g-color-primary--hover']) ?>
                     </h2>
                     <?= Html::a('Ver más', ['social/view', 'id' => $article->id], ['class' => 'g-color-gray-dark-v2 g-color-primary--hover g-font-weight-600 g-font-size-12 g-text-underline--none--hover text-uppercase']) ?>
                   </div>
                 </div>
               </article>
               <!-- End Blog Minimal Blocks -->
             <?php endif; ?>
             <hr class="g-mb-60 g-mx-15 g-brd-gray-light-v4">
          <?php endforeach; ?>
        <?php else : ?>
          <h3 class="h5 g-color-black g-font-weight-600 g-mb-30">No hay artículos que mostrar</h3>
        <?php endif; ?>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-3 g-brd-left--lg g-brd-secondary-opacity-0_3 g-mb-80 g-hidden-md-down">
        <div class="g-pl-20--lg">
          <div class="js-sticky-block g-sticky-block--lg" data-start-point="#stickyblock-start" data-end-point="#stickyblock-end">

          <!-- Search -->
          <div class="g-mb-50">
            <h3 class="h5 g-color-black g-font-weight-600 g-mb-30">Instagram</h3>
            <div class="row">
              <?php foreach (Instagram::getLatestPhotos() as $instagram) : ?>
                <div class="col-md-12 g-mb-30">
                    <?=
                      Html::a(
                        Html::img($instagram->low_resolution, ['class' => 'img-fluid']),
                        $instagram->url,
                        [
                          'class' => 'js-fancybox',
                          'data-fancybox-gallery' => 'lightbox-gallery--col2',
                          'target' => '_blank',
                        ]
                      )
                    ?>
                </div>
              <?php endforeach; ?>
            </div>

          </div>
          <!-- End Search -->

        </div>
      </div>
    </div>
    <!-- End Sidebar -->
  </div>
</div>
<!-- End Blog Minimal Blocks -->
