<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\assets\ClinicAsset;

ClinicAsset::register($this);

$this->title = 'Calendario';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
  <div id="app-root"></div>
</div>
