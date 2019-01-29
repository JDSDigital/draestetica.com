<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $article->title;
$this->params['breadcrumbs'][] = ['label' => 'Social', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- News Content -->
<section class="g-pt-50 g-pb-100">
  <div class="container">
    <div class="row">
      <!-- Articles Content -->
      <div class="col-lg-9 g-mb-50 g-mb-0--lg">
        <article class="g-mb-60">
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
              <?= Html::img($article->cover->getImage(), ['class' => 'img-fluid w-100', 'alt' => $article->title]) ?>
            </figure>

            <?= $article->article ?>
            <br />
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
            <div class="u-heading-v3-1 g-mb-30">
              <h2 class="h5 u-heading-v3__title g-color-gray-dark-v1 text-uppercase g-brd-secondary-opacity-0_3">Noticias relacionadas</h2>
            </div>

            <div class="row">
                <?php foreach($article->getRelated() as $key => $value) : ?>
                  <!-- Article Video -->
                  <div class="col-lg-4 col-sm-6 g-mb-30">
                    <article>
                      <figure class="u-shadow-v25 g-pos-rel g-mb-20 w-100">
                        <?= Html::img($value->cover->getThumb(), ['class' => 'img-fluid crop-related', 'alt' => $value->title]) ?>
                      </figure>

                      <h3 class="g-font-size-16 g-mb-10">
                        <?= Html::a($value->title, ['social/view', 'id' => $value->id], ['class' => 'u-link-v5 g-color-gray-dark-v1 g-color-primary--hover']) ?>
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
                    'id' => 'social-search',
                    'action' => ['/social/index']
                  ]);
              ?>
              <div class="g-mb-50">
                <h3 class="h5 g-color-black g-font-weight-600 mb-4">Buscar</h3>
                <div class="input-group">
                  <input type="text" id="socialsearch-title" class="form-control g-brd-secondary-opacity-0_3 g-placeholder-gray-dark-v5 border-right-0 g-rounded-left-50 g-px-15" name="SocialSearch[title]" placeholder="Escribe aquí...">
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
              <h3 class="h5 g-color-black g-font-weight-600 g-mb-30">Instagram</h3>
              <div class="row">
                <div class="col-md-12 g-mb-30">
                  <a class="js-fancybox" data-fancybox-gallery="lightbox-gallery--col2" href="../img-temp/500x450/img3.jpg" title="Lightbox Gallery">
                    <img class="img-fluid" src="../img-temp/500x450/img3.jpg" alt="Image Description">
                  </a>
                </div>
                <div class="col-md-12 g-mb-30">
                  <a class="js-fancybox" data-fancybox-gallery="lightbox-gallery--col2" href="../img-temp/500x450/img4.jpg" title="Lightbox Gallery">
                    <img class="img-fluid" src="../img-temp/500x450/img4.jpg" alt="Image Description">
                  </a>
                </div>
                <div class="col-md-12 g-mb-30">
                  <a class="js-fancybox" data-fancybox-gallery="lightbox-gallery--col2" href="../img-temp/500x450/img5.jpg" title="Lightbox Gallery">
                    <img class="img-fluid" src="../img-temp/500x450/img5.jpg" alt="Image Description">
                  </a>
                </div>
                <div class="col-md-12 g-mb-30">
                  <a class="js-fancybox" data-fancybox-gallery="lightbox-gallery--col2" href="../img-temp/500x450/img6.jpg" title="Lightbox Gallery">
                    <img class="img-fluid" src="../img-temp/500x450/img6.jpg" alt="Image Description">
                  </a>
                </div>
                <div class="col-md-12 g-mb-30">
                  <a class="js-fancybox" data-fancybox-gallery="lightbox-gallery--col2" href="../img-temp/500x450/img6.jpg" title="Lightbox Gallery">
                    <img class="img-fluid" src="../img-temp/500x450/img7.jpg" alt="Image Description">
                  </a>
                </div>
              </div>

            </div>
            <!-- End Search -->

          </div>
        </div>
      </div>
      <!-- End Sidebar -->
    </div>
  </div>
</section>
<!-- End News Content -->
