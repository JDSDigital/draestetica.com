<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="row">
  <div class="col-lg-12">
    <section class="panel ml10 mr10 pb50">
        <header class="panel-heading">
            <h1><?= Html::encode($this->title) ?></h1>
        </header>

        <div class="alert alert-danger mr20 ml20">
            <?= nl2br(Html::encode($message)) ?>
        </div>

    </section>
  </div>
</div>

