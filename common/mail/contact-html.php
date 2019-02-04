<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="password-reset">

    <p>Ha recibido el siguiente mensaje desde la página web:</p>
    <p><strong>Nombre: </strong> <?= $name ?></p>
    <p><strong>Teléfono: </strong> <?= $phone ?></p>
    <p><strong>Correo: </strong> <?= $email ?></p>
    <p><strong>Mensaje: </strong> <?= $body ?></p>

</div>
