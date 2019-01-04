<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Social';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Blog Masonry Blocks -->
    <div class="container-fluid g-pt-100 g-pb-70">
      <div class="masonry-grid row g-mb-70">
        <div class="masonry-grid-sizer col-sm-1"></div>

        <div class="masonry-grid-item col-sm-6 col-lg-4 g-mb-30">
          <!-- Article -->
          <article class="u-shadow-v11 g-bg-white g-pos-rel">
            <img class="img-fluid w-100" src="../img-temp/600x300/img1.jpg" alt="Image Description">
            <div class="g-pa-30">
              <div class="mb-4">
                <h3 class="h4 g-color-black g-font-weight-600 text-capitalize mb-3">
                    <?= Html::a('Lorem Ipsum', ['social/view'], ['class' => 'g-color-black g-color-primary--hover g-text-underline--none--hover']) ?>
                  </h3>
                <p class="g-color-gray-dark-v5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac sapien justo.</p>
              </div>
              <div class="d-flex justify-content-start">
                <a class="align-self-center g-color-gray-dark-v5 g-color-black--hover g-text-underline--none--hover" href="#">Noticias</a>
                <?= Html::a('Ver más', ['social/view'], ['class' => 'align-self-center ml-auto']) ?>
              </div>
            </div>
          </article>
          <!-- End Article -->
        </div>

        <div class="masonry-grid-item col-sm-6 col-lg-4 g-mb-30">
          <!-- Article -->
          <article class="u-shadow-v11 g-bg-white g-pos-rel">
            <div class="g-pa-30">
              <div class="mb-4">
                <h3 class="h4 g-color-black g-font-weight-600 text-capitalize mb-3">
                    <?= Html::a('Lorem Ipsum', ['social/view'], ['class' => 'g-color-black g-color-primary--hover g-text-underline--none--hover']) ?>
                  </h3>
                <p class="g-color-gray-dark-v5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac sapien justo.</p>
              </div>
              <div class="d-flex justify-content-start">
                <a class="align-self-center g-color-gray-dark-v5 g-color-black--hover g-text-underline--none--hover" href="#">Notas de prensa</a>
                <?= Html::a('Ver más', ['social/view'], ['class' => 'align-self-center ml-auto']) ?>
              </div>
            </div>
          </article>
          <!-- End Article -->
        </div>

        <div class="masonry-grid-item col-sm-6 col-lg-4 g-mb-30">
          <!-- Article -->
          <article class="u-shadow-v11 g-bg-white g-pos-rel">
            <img class="img-fluid w-100" src="../img-temp/700x350/img1.jpg" alt="Image Description">
            <div class="g-pa-30">
              <div class="mb-4">
                <h3 class="h4 g-color-black g-font-weight-600 text-capitalize mb-3">
                    <?= Html::a('Lorem Ipsum', ['social/view'], ['class' => 'g-color-black g-color-primary--hover g-text-underline--none--hover']) ?>
                  </h3>
                <p class="g-color-gray-dark-v5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac sapien justo.</p>
              </div>
              <div class="d-flex justify-content-start">
                <a class="align-self-center g-color-gray-dark-v5 g-color-black--hover g-text-underline--none--hover" href="#">Noticias</a>
                <?= Html::a('Ver más', ['social/view'], ['class' => 'align-self-center ml-auto']) ?>
              </div>
            </div>
          </article>
          <!-- End Article -->
        </div>

        <div class="masonry-grid-item col-sm-6 col-lg-4 g-mb-30">
          <!-- Article -->
          <article class="u-shadow-v11 g-bg-white g-pos-rel">
            <img class="img-fluid w-100" src="../img-temp/500x450/img1.jpg" alt="Image Description">
            <div class="g-pa-30">
              <div class="mb-4">
                <h3 class="h4 g-color-black g-font-weight-600 text-capitalize mb-3">
                    <?= Html::a('Lorem Ipsum', ['social/view'], ['class' => 'g-color-black g-color-primary--hover g-text-underline--none--hover']) ?>
                  </h3>
                <p class="g-color-gray-dark-v5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac sapien justo.</p>
              </div>
              <div class="d-flex justify-content-start">
                <a class="align-self-center g-color-gray-dark-v5 g-color-black--hover g-text-underline--none--hover" href="#">Galería</a>
                <?= Html::a('Ver más', ['social/view'], ['class' => 'align-self-center ml-auto']) ?>
              </div>
            </div>
          </article>
          <!-- End Article -->
        </div>

        <div class="masonry-grid-item col-sm-6 col-lg-4 g-mb-30">
          <!-- Article -->
          <article class="u-shadow-v11 g-bg-white g-pos-rel">
            <img class="img-fluid w-100" src="../img-temp/600x450/img1.jpg" alt="Image Description">
            <div class="g-pa-30">
              <div class="mb-4">
                <h3 class="h4 g-color-black g-font-weight-600 text-capitalize mb-3">
                    <?= Html::a('Lorem Ipsum', ['social/view'], ['class' => 'g-color-black g-color-primary--hover g-text-underline--none--hover']) ?>
                  </h3>
                <p class="g-color-gray-dark-v5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac sapien justo.</p>
              </div>
              <div class="d-flex justify-content-start">
                <a class="align-self-center g-color-gray-dark-v5 g-color-black--hover g-text-underline--none--hover" href="#">Galería</a>
                <?= Html::a('Ver más', ['social/view'], ['class' => 'align-self-center ml-auto']) ?>
              </div>
            </div>
          </article>
          <!-- End Article -->
        </div>

        <div class="masonry-grid-item col-sm-6 col-lg-4 g-mb-30">
          <!-- Article -->
          <article class="u-shadow-v11 g-bg-white g-pos-rel">
            <div class="g-pa-30">
              <div class="mb-4">
                <h3 class="h4 g-color-black g-font-weight-600 text-capitalize mb-3">
                    <?= Html::a('Lorem Ipsum', ['social/view'], ['class' => 'g-color-black g-color-primary--hover g-text-underline--none--hover']) ?>
                  </h3>
                <p class="g-color-gray-dark-v5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac sapien justo.</p>
              </div>
              <div class="d-flex justify-content-start">
                <a class="align-self-center g-color-gray-dark-v5 g-color-black--hover g-text-underline--none--hover" href="#">Galería</a>
                <?= Html::a('Ver más', ['social/view'], ['class' => 'align-self-center ml-auto']) ?>
              </div>
            </div>
          </article>
          <!-- End Article -->
        </div>

        <div class="masonry-grid-item col-sm-6 col-lg-4 g-mb-30">
          <!-- Article -->
          <article class="u-shadow-v11 g-bg-white g-pos-rel">
            <img class="img-fluid w-100" src="../img-temp/600x300/img2.jpg" alt="Image Description">
            <div class="g-pa-30">
              <div class="mb-4">
                <h3 class="h4 g-color-black g-font-weight-600 text-capitalize mb-3">
                    <?= Html::a('Lorem Ipsum', ['social/view'], ['class' => 'g-color-black g-color-primary--hover g-text-underline--none--hover']) ?>
                  </h3>
                <p class="g-color-gray-dark-v5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac sapien justo.</p>
              </div>
              <div class="d-flex justify-content-start">
                <a class="align-self-center g-color-gray-dark-v5 g-color-black--hover g-text-underline--none--hover" href="#">Noticias</a>
                <?= Html::a('Ver más', ['social/view'], ['class' => 'align-self-center ml-auto']) ?>
              </div>
            </div>
          </article>
          <!-- End Article -->
        </div>

      </div>

    </div>
    <!-- End Blog Masonry Blocks -->
