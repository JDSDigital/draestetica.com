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
                <h1>Selecciona un servicio:</h1>
                <?php if ($models) : ?>
                    <?php foreach ($models as $category => $subcategories) : ?>
                        <h2 class="h3 u-heading-v1__title"><?= $category ?></h2>
                        <?php foreach ($subcategories as $subcategory => $services) : ?>
                            <h4 class="g-font-weight-200 g-mb-10"><?= $subcategory ?></h4>
                            <ul>
                            <?php foreach ($services as $service) : ?>
                                <?= Html::a('<li>' . $service->name . '</li>', ['//clientes/panel/agendar', 'id' => $service->id], ['class' => 'u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer']) ?>
                            <?php endforeach; ?>
                            </ul>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h3 class="h5 g-color-black g-font-weight-600 g-mb-30">No hay servicios que mostrar</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
