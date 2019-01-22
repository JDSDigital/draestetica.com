<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Partners;

/* @var $this yii\web\View */
/* @var $model common\models\Partners */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
  <div class="col-lg-12">
    <section class="panel ml10 mr10">
      <header class="panel-heading">
        <?= Html::a('<i class="icon-pencil5 mr5"></i>Modificar', ['update', 'id' => $model->id], ['class' => 'btn bg-success btn-xs']) ?>
        <?= Html::a('<i class="fa fa-remove mr5"></i>Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn bg-danger btn-xs',
            'data' => [
                'confirm' => '¿Seguro deseas borrar este partner?',
                'method' => 'post',
            ],
        ]) ?>
      </header>

      <div class="row">
        <div class="col-lg-4">
          <?= Html::img($model->logo, ['class' => 'img-responsive p20']) ?>
        </div>
      </div>

      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              [
                  'attribute' => 'status',
                  'value' => function ($model) {
                      return ($model->status == Partners::STATUS_ACTIVE) ? 'Activo' : 'Inactivo';
                  },
              ],
              'name',
              'description',
              'url:url',
              [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('d-m-Y', $model->created_at);
                },
              ],
              [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return date('d-m-Y', $model->updated_at);
                },
              ],
          ],
      ]) ?>
    </section>
  </div>
</div>
