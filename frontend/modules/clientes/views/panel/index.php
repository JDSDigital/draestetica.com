<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Área de clientes';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="g-mb-100">
    <div class="">
        <div class="row">
            <?= $this->render('_sidebar'); ?>
            
            <div class="col-lg-9">
                <h3>Próximas citas:</h3>
                <div class="row">
                    <?php foreach(Yii::$app->user->identity->appointments as $appointment) : ?>
                        <div class="col-lg-12 g-mb-20">
                            <div class="h-100 g-flex-middle g-brd-around g-brd-gray-light-v4 g-brd-left-3 g-brd-blue-left rounded g-transition-0_3 g-pa-20 g-mr-20">
                                <h4><?= $appointment->service->name ?></h4>
                                <h6 class="g-mb-0"><?= $appointment->date ?></h6>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
