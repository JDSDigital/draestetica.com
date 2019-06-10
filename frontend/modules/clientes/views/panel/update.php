<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Actualizar cliente';
$this->params['breadcrumbs'][] = ['label' => 'Área de clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar cliente';
?>
<section class="g-mb-100">
    <div class="">
        <div class="row">
            <?= $this->render('_sidebar'); ?>
            
            <div class="col-lg-9">
                <h1>Bienvenido <?= Yii::$app->user->identity->name ?></h1>
            </div>
        </div>
    </div>
</section>
