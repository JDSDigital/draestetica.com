<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $article->title;
$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $article->title;
?>

<!-- News Content -->
<section class="g-pt-50 g-pb-100">
  <div class="container">
    <div class="row">
      <!-- Articles Content -->
      <div class="col-lg-9 g-mb-50 g-mb-0--lg">
        <article class="g-mb-60 g-pr-30">
          <header class="g-mb-30">
            <h2 class="h1 g-mb-15"><?= $article->title ?></h2>

            <ul class="list-inline d-sm-flex g-color-gray-dark-v4 mb-0">
              <li class="list-inline-item">
                <?= Yii::$app->formatter->asDate($article->created_at, 'long') ?>
              </li>
              <li class="list-inline-item ml-auto">
                <i class="icon-eye u-line-icon-pro align-middle mr-1"></i> Vistas <?= $article->views ?>
              </li>
            </ul>

            <hr class="g-brd-gray-light-v4 g-my-15">

            <ul class="list-inline text-uppercase mb-0">
              <li class="list-inline-item g-mr-10">
                <a class="btn u-btn-facebook g-font-size-12 rounded g-px-20--sm g-py-10" href="#">
                  <i class="fa fa-facebook g-mr-5--sm"></i> <span class="g-hidden-xs-down">Compartir en Facebook</span>
                </a>
              </li>
              <li class="list-inline-item g-mr-10">
                <a class="btn u-btn-twitter g-font-size-12 rounded g-px-20--sm g-py-10" href="#">
                  <i class="fa fa-twitter g-mr-5--sm"></i> <span class="g-hidden-xs-down">Compartir en Twitter</span>
                </a>
              </li>
            </ul>
          </header>

          <div class="g-font-size-16 g-line-height-1_8 g-mb-30">
            <figure class="u-shadow-v25 g-mb-30">
              <?= Html::img($article->getImage(), ['class' => 'img-fluid w-100', 'alt' => $article->title]) ?>
            </figure>

            <?= $article->article ?>
            <br />
            <?= ($article->author) ? '<p>Autor: ' . $article->author . '</p>' : '' ?>
            <?= ($article->source) ? '<p>Fuente: ' . $article->source . '</p>' : '' ?>

          </div>

          <hr class="g-brd-gray-light-v4">

          <!-- Social Shares -->
          <div class="g-mb-30">
            <ul class="list-inline text-uppercase mb-0">
              <li class="list-inline-item g-mr-10">
                <a class="btn u-btn-facebook g-font-size-12 rounded g-px-20--sm g-py-10" href="#">
                  <i class="fa fa-facebook g-mr-5--sm"></i> <span class="g-hidden-xs-down">Compartir en Facebook</span>
                </a>
              </li>
              <li class="list-inline-item g-mr-10">
                <a class="btn u-btn-twitter g-font-size-12 rounded g-px-20--sm g-py-10" href="#">
                  <i class="fa fa-twitter g-mr-5--sm"></i> <span class="g-hidden-xs-down">Compartir en Twitter</span>
                </a>
              </li>
            </ul>
          </div>
          <!-- End Social Shares -->

          <hr class="g-brd-gray-light-v4 g-mb-40">

          <!-- Related Articles -->
          <div class="g-mb-40">
            <h3 class="h5 g-color-black g-font-weight-600 g-mb-30">Noticias Relacionadas</h3>

            <div class="row">

              <?php foreach($article->getRelated() as $key => $value) : ?>
                <!-- Article Video -->
                <div class="col-lg-4 col-sm-6 g-mb-30">
                  <article>
                    <figure class="u-shadow-v25 g-pos-rel g-mb-20 w-100">
                      <?= Html::img($value->getThumb(), ['class' => 'img-fluid crop-related', 'alt' => $value->title]) ?>
                    </figure>

                    <h3 class="g-font-size-16 g-mb-10">
                      <?= Html::a($value->title, ['blog/view', 'id' => $value->id], ['class' => 'u-link-v5 g-color-gray-dark-v1 g-color-primary--hover']) ?>
                    </h3>
                  </article>
                </div>
                <!-- End Article Video -->
              <?php endforeach; ?>

            </div>
          </div>

        </article>

        <div id="stickyblock-end"></div>
      </div>
      <!-- End Articles Content -->

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
</section>
<!-- End News Content -->
