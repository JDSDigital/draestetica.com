<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Contacto';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Contact Form -->
<section class="container g-py-70">
  <div class="row g-mb-20">
    <div class="col-lg-6 g-mb-50">
      <!-- Heading -->
      <h2 class="h1 g-color-black g-font-weight-700 mb-4">¿Cómo podemos ayudarte?</h2>
      <p class="g-font-size-18 mb-0">Morbi a suscipit ipsum. Suspendisse mollis libero ante. Pellentesque finibus convallis nulla vel placerat.</p>
      <!-- End Heading -->
    </div>
    <div class="col-lg-3 align-self-end ml-auto g-mb-50">
      <div class="media">
        <div class="d-flex align-self-center">
          <span class="u-icon-v2 u-icon-size--sm g-color-white bg-theme-gradient-v1 rounded-circle mr-3">
              <i class="g-font-size-16 icon-communication-033 u-line-icon-pro"></i>
            </span>
        </div>
        <div class="media-body align-self-center">
          <h3 class="h6 g-color-black g-font-weight-700 text-uppercase mb-0">Teléfono</h3>
          <p class="mb-0">+56 (9) 1234 5678</p>
        </div>
      </div>
    </div>

    <div class="col-lg-3 align-self-end ml-auto g-mb-50">
      <div class="media">
        <div class="d-flex align-self-center">
          <span class="u-icon-v2 u-icon-size--sm g-color-white bg-theme-gradient-v1 rounded-circle mr-3">
              <i class="g-font-size-16 icon-communication-062 u-line-icon-pro"></i>
            </span>
        </div>
        <div class="media-body align-self-center">
          <h3 class="h6 g-color-black g-font-weight-700 text-uppercase mb-0">Correo</h3>
          <p class="mb-0">contacto@draestetica.com</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-5">
      <form>
        <div class="row">
          <div class="col-md-12 form-group g-mb-20">
            <label class="g-color-gray-dark-v2 g-font-size-13">Nombre</label>
            <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" type="text" placeholder="Nombre">
          </div>
        </div>

        <div class="g-mb-20">
          <label class="g-color-gray-dark-v2 g-font-size-13">Correo</label>
          <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" type="email" placeholder="ejemplo@correo.com">
        </div>

        <div class="g-mb-20">
          <label class="g-color-gray-dark-v2 g-font-size-13">Teléfono</label>
          <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" type="tel" placeholder="+56 9 1234 5678">
        </div>

      </form>
    </div>
    <div class="col-md-7">
      <div class="g-mb-40">
        <label class="g-color-gray-dark-v2 g-font-size-13">Mensaje</label>
        <textarea class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus g-resize-none rounded-3 g-py-13 g-px-15" rows="12" placeholder="Escriba aquí su mensaje..."></textarea>
      </div>

      <div class="text-right">
        <button class="btn u-btn-gradient-theme-v1 g-font-weight-600 g-font-size-13 text-uppercase rounded-3 g-py-12 g-px-35" type="submit" role="button">Enviar</button>
      </div>
    </div>
  </div>
</section>
<!-- End Contact Form -->
