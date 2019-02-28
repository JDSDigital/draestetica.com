<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $service->title;
$this->params['breadcrumbs'][] = ['label' => 'Clinic', 'url' => ['index']];
$this->params['breadcrumbs'][] = $service->title;
?>
