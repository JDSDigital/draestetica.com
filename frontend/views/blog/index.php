<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Blog Minimal Blocks -->
<div class="container g-pt-70 g-pb-20">
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
                     <?= Html::a($article->title, ['blog/view', 'id' => $article->id], ['class' => 'u-link-v5 g-color-black g-color-primary--hover']) ?>
                   </h2>
                 </div>
                 <div class="g-overflow-hidden">
                   <?= Html::img($article->getImage(), ['class' => 'img-fluid w-100 u-block-hover__main--mover-down crop', 'alt' => $article->title]) ?>
                 </div>
                 <div class="g-px-100--md g-py-30--md">
                   <div class="mb-4">
                     <p class="g-font-size-18 g-line-height-2 mb-0"><?= $article->summary ?></p>
                   </div>
                   <?= Html::a('Ver más', ['blog/view', 'id' => $article->id], ['class' => 'g-color-gray-dark-v2 g-color-primary--hover g-font-weight-600 g-font-size-12 g-text-underline--none--hover text-uppercase']) ?>
                 </div>
               </article>
               <!-- End Blog Minimal Blocks -->
             <?php else : ?>
               <!-- Blog Minimal Blocks -->
               <article class="row align-items-center u-block-hover">
                 <div class="col-md-6 g-mb-30">
                   <div class="g-overflow-hidden">
                     <?= Html::img($article->getImage(), ['class' => 'img-fluid w-100 u-block-hover__main--mover-down g-mb-minus-6', 'alt' => $article->title]) ?>
                   </div>
                 </div>
                 <div class="col-md-6 g-mb-30">
                   <div class="g-pa-30--md">
                     <ul class="list-inline g-color-gray-dark-v4 g-font-weight-600 g-font-size-12">
                       <li class="list-inline-item"><?= Yii::$app->formatter->asDate($article->created_at, 'long') ?></li>
                     </ul>
                     <h2 class="h3 g-color-black g-font-weight-600 mb-4">
                       <?= Html::a($article->title, ['blog/view', 'id' => $article->id], ['class' => 'u-link-v5 g-color-black g-color-primary--hover']) ?>
                     </h2>
                     <?= Html::a('Ver más', ['blog/view', 'id' => $article->id], ['class' => 'g-color-gray-dark-v2 g-color-primary--hover g-font-weight-600 g-font-size-12 g-text-underline--none--hover text-uppercase']) ?>
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
          <div class="js-sticky-block g-sticky-block--lg g-pt-50" data-start-point="#stickyblock-start" data-end-point="#stickyblock-end">
          <!-- Search -->
          <?php
              $form = ActiveForm::begin([
                'id' => 'blog-search',
                'action' => ['/blog/index']
              ]);
          ?>
          <div class="g-mb-50">
            <h3 class="h5 g-color-black g-font-weight-600 mb-4">Buscar</h3>
            <div class="input-group">
              <input type="text" id="blogsearch-title" class="form-control g-brd-secondary-opacity-0_3 g-placeholder-gray-dark-v5 border-right-0 g-rounded-left-50 g-px-15" name="BlogSearch[title]" placeholder="Escribe aquí...">
              <span class="input-group-btn">
                <?= Html::submitButton('<i class="icon-magnifier g-pos-rel g-top-1"></i>', [
                    'class' => 'btn u-btn-gradient-theme-v1 g-rounded-right-50 g-py-13 g-px-20 border-0',
                ]) ?>
              </span>
            </div>
          </div>
          <?php ActiveForm::end(); ?>
          <!-- End Search -->

          <hr class="g-brd-gray-light-v4 g-my-50">

          <!-- Search -->
          <div class="g-mb-50">
            <h3 class="h5 g-color-black g-font-weight-600 g-mb-30">Últimos Artículos</h3>

            <?php foreach ($latest as $key => $value) : ?>
              <!-- Article -->
              <article class="media g-mb-30">
                <a class="d-flex u-shadow-v25 mr-3" href="#">
                  <?= Html::img($value->getThumb(), ['class' => 'g-width-60 crop-thumb', 'alt' => $value->title]) ?>
                </a>

                <div class="media-body">
                  <h3 class="h6">
                    <?= Html::a($value->title, ['blog/view', 'id' => $value->id], ['class' => 'u-link-v5 g-color-gray-dark-v1 g-color-primary--hover']) ?>
                  </h3>

                  <ul class="u-list-inline g-font-size-12 g-color-gray-dark-v4">
                    <li class="list-inline-item">
                      <?= Yii::$app->formatter->asDate($value->created_at, 'long') ?>
                    </li>
                  </ul>
                </div>
              </article>
              <!-- End Article -->
            <?php endforeach; ?>


          </div>
          <!-- End Search -->

          <hr class="g-brd-gray-light-v4 g-my-50">

          <!-- Tags -->
          <div class="g-mb-40">
            <h3 class="h5 g-color-black g-font-weight-600 g-mb-30">Temas</h3>
            <ul class="u-list-inline mb-0">
              <?php foreach ($tags as $key => $tag) : ?>
                <li class="list-inline-item g-mb-10">
                  <?= Html::a($tag, ['blog/index'], [
                    'class' => 'u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 bg-theme-gradient-v1--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15',
                    'data-method' => 'POST',
                    'data-params' => [
                        'tag_id' => $key
                    ],
                  ]) ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <!-- End Tags -->

        </div>
      </div>
    </div>
    <!-- End Sidebar -->
  </div>
</div>
<!-- End Blog Minimal Blocks -->
