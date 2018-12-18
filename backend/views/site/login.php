<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-container login-container">
	<div class="page-container">
		<div class="content-wrapper">
			<div class="content">
                <!-- Simple login form -->
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                            <h5 class="content-group">Ingresa a tu cuenta <small class="display-block">Introduce tus credenciales abajo</small></h5>
                        </div>

                        <?= $form->field($model, 'email', [
                            'options'      => ['class' => 'form-group  has-feedback has-feedback-left'],
                            'inputOptions' => [
                                'class'       => 'input-lg form-control',
                                'placeholder' => Yii::t('app', 'Correo'),
                            ],
                            'template'     => '{input}<div class="form-control-feedback"><i class="fa fa-user fa-lg text-muted"></i></div>{error}{hint}',
                        ]); ?>

                        <?= $form->field($model, 'password', [
                            'options'      => ['class' => 'form-group  has-feedback has-feedback-left'],
                            'inputOptions' => [
                                'class'       => 'input-lg form-control',
                                'placeholder' => Yii::t('app', 'Contraseña'),
                            ],
                            'template'     => '{input}<div class="form-control-feedback"><i class="fa fa-lock fa-lg text-muted"></i></div>{error}{hint}',
                        ])->passwordInput(); ?>

                        <div class="form-group">
                            <?= Html::submitButton('Login <i class="icon-circle-right2 position-right"></i>', ['class' => 'btn bg-primary btn-block', 'name' => 'login-button']) ?>
                        </div>

                    </div>
                <?php ActiveForm::end(); ?>
                <!-- /simple login form -->
            </div>
        </div>
    </div>
</div>
