<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\assets\NivoAsset;
use common\models\Instagram;

NivoAsset::register($this);

$this->title = $article->title;
$this->params['breadcrumbs'][] = ['label' => 'Social', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- News Content -->
<section class="g-pt-30 g-pb-100">
  <div class="container">
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
      </div>
    </div>
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
                <a class="btn u-btn-facebook g-font-size-12 rounded g-px-20--sm g-py-10"
                  onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=<?= Url::to(['//social/view', 'id' => $article->id], true) ?>', 'newwindow', 'width=600,height=350'); return false;"
                  href="http://www.facebook.com/sharer/sharer.php?u=<?= Url::to(['//social/view', 'id' => $article->id], true) ?>">
                  <i class="fa fa-facebook g-mr-5--sm"></i> <span class="g-hidden-xs-down">Compartir en Facebook</span>
                </a>
              </li>
              <li class="list-inline-item g-mr-10">
                <a class="btn u-btn-twitter  g-color-white g-font-size-12 rounded g-px-20--sm g-py-10"
                  onclick="window.open('http://twitter.com/share?text=He%20visto%20este%20artículo%20en%20draestetica.com%20->&url=<?= Url::to(['//social/view', 'id' => $article->id], true) ?>', 'newwindow', 'width=600,height=300'); return false;">
                  <i class="fa fa-twitter g-mr-5--sm"></i> <span class="g-hidden-xs-down">Compartir en Twitter</span>
                </a>
              </li>
            </ul>
          </header>

          <div class="g-font-size-16 g-line-height-1_8 g-mb-30">

              <!-- Product Image Slider -->

        			<div class="slider-wrapper theme-default shop-carousel g-mb-30">
          				<div id="slider-shop" class="nivoSlider">
          					<?php foreach ($article->images as $image) : ?>
          						<?= Html::a(Html::img($image->getImage(), ['data-thumb' => $image->getThumb()]), $image->getImage(), ['data-lightbox-gallery'=>'gallery']) ?>
          					<?php endforeach; ?>
          				</div>
        			</div>

              <!-- End of Product Image Slider -->

            <?= $article->article ?>
            <br />
            <?= ($article->source) ? '<p>Fuente: ' . $article->source . '</p>' : '' ?>

          </div>

          <hr class="g-brd-gray-light-v4">

          <!-- Social Shares -->
          <div class="g-mb-30">
            <ul class="list-inline text-uppercase mb-0">
              <li class="list-inline-item g-mr-10">
                <a class="btn u-btn-facebook g-font-size-12 rounded g-px-20--sm g-py-10"
                  onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=<?= Url::to(['//social/view', 'id' => $article->id], true) ?>', 'newwindow', 'width=600,height=350'); return false;"
                  href="http://www.facebook.com/sharer/sharer.php?u=<?= Url::to(['//social/view', 'id' => $article->id], true) ?>">
                  <i class="fa fa-facebook g-mr-5--sm"></i> <span class="g-hidden-xs-down">Compartir en Facebook</span>
                </a>
              </li>
              <li class="list-inline-item g-mr-10">
                <a class="btn u-btn-twitter  g-color-white g-font-size-12 rounded g-px-20--sm g-py-10"
                  onclick="window.open('http://twitter.com/share?text=He%20visto%20este%20artículo%20en%20draestetica.com%20->&url=<?= Url::to(['//social/view', 'id' => $article->id], true) ?>', 'newwindow', 'width=600,height=300'); return false;">
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
</section>
<!-- End News Content -->
