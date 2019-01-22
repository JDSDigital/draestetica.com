<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Partners';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="partners">
  <div class="row text-center">

    <?php foreach ($partners as $partner) : ?>
      <div class="col-lg-2 col-md-3 col-sm-4">
        <div class="logo-box vertical-align">
          <div class="logo-inner-box">
            <a href="<?= Url::to($partner->url, 'http') ?>" target="_blank">
              <span class="thumb" data-toggle="tooltip" data-html="true" data-title="<h3><?= $partner->name ?></h3><h6><?= $partner->description ?></h6>"><?= Html::img('@web/img/logos/'.$partner->file, ['class' => 'img-responsive', 'alt' => $partner->name]) ?></span>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</div>

<?php
$js = <<<JS
  $('.logo-box').SameHeight();
JS;
$this->registerJs($js);
?>
