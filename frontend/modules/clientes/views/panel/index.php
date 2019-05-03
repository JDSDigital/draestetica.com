<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Área de clientes';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Bienvenido <?= Yii::$app->user->identity->name ?></h1>
