<?php

use yii\helpers\Html;

?>

<!-- Profile Sidebar -->
<div class="col-lg-3 g-mb-50 g-mb-0--lg">

    <!-- Sidebar Navigation -->
    <div class="list-group list-group-border-0 g-mb-40">
        <!-- Dashboard -->
        <?= Html::a('<span><i class="icon-home g-pos-rel g-top-1 g-mr-8"></i> Dashboard</span>',
            ['index'],
            ['class' => (Yii::$app->controller->action->id == 'index') 
                ? 'list-group-item justify-content-between active' 
                : 'list-group-item justify-content-between '
            ]) ?>
        <!-- End Dashboard -->

        <!-- Profile -->
        <?= Html::a('<span><i class="icon-cursor g-pos-rel g-top-1 g-mr-8"></i> Perfil</span>',
            ['update'],
            ['class' => (Yii::$app->controller->action->id == 'update') 
                ? 'list-group-item list-group-item-action justify-content-between active' 
                : 'list-group-item list-group-item-action justify-content-between'
            ]) ?>
        <!-- End Profile -->

        <!-- Appointments -->
        <?= Html::a('<span><i class="icon-notebook g-pos-rel g-top-1 g-mr-8"></i> Citas</span>',
            ['citas'],
            ['class' => (Yii::$app->controller->action->id == 'citas'
                || Yii::$app->controller->action->id == 'agendar') 
                ? 'list-group-item list-group-item-action justify-content-between active' 
                : 'list-group-item list-group-item-action justify-content-between'
            ]) ?>
        <!-- End Appointments -->

        <!-- Settings -->
        <!-- <a href="page-profile-settings-1.html" class="list-group-item list-group-item-action justify-content-between">
        <span><i class="icon-settings g-pos-rel g-top-1 g-mr-8"></i> Opciones</span>
        </a> -->
        <!-- End Settings -->

        <!-- Logout -->
        <?= Html::a('<span><i class="icon-logout g-pos-rel g-top-1 g-mr-8"></i> Salir</span>',
            ['/site/logout'],
            ['data' => [
                'method' => 'post',
            ], 'class' => 'list-group-item list-group-item-action justify-content-between']);
        ?>
        <!-- End Logout -->
    </div>
    <!-- End Sidebar Navigation -->

</div>
<!-- End Profile Sidebar -->