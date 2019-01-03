<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Dra. Estética';
?>
<div class="home-banner">

    <!-- Promo Block -->
    <section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll loaded dzsprx-readyall" data-options='{direction: "reverse", settings_mode_oneelement_max_offset: "150"}'>
      <div class="divimage dzsparallaxer--target w-100 g-bg-pos-top-center"></div>

      <div class="container g-pb-170 g-pt-50">
        <div class="row">
          <div class="col-md-6 text-center">
            <?= Html::img('@web/img/logo/logo-nomargin.png') ?>
            <h2 class="g-color-black g-font-weight-300 g-font-size-56 g-line-height-1_3">Dra. Estética</h2>
            <span class="d-block g-color-black-opacity-0_8 g-font-weight-300 g-font-size-30 g-line-height-1_2 mb-3">"Una mezcla perfecta<br />entre salud y belleza"</span>
            <a href="#" class="btn btn-xl u-btn-gradient-theme-v1 g-mr-10 g-mb-15">Conócenos</a>
          </div>
        </div>
      </div>
    </section>
    <!-- End Promo Block -->

</div>
