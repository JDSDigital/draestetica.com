<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Área de clientes';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="g-mb-100">
    <div class="container-fluid">
        <div class="row">
            <?= $this->render('_sidebar'); ?>
            
            <div class="col-lg-9">
                <h1>Bienvenido <?= Yii::$app->user->identity->name ?></h1>
            </div>
        </div>
    </div>
</section>
