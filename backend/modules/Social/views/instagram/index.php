<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\Instagram;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SocialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instagram';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-lg-12">
    <section class="panel ml10 mr10">
      <header class="panel-heading">
        <?= Html::a('<i class="fa fa-plus mr5"></i>Actualizar', ['update'], ['class' => 'btn bg-success btn-xs']) ?>
      </header>

      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options'        => [
          'class' => 'grid-view table-responsive',
        ],
        'tableOptions'   => [
          'class' => 'table table-striped table-hover',
        ],
        'pager'          => [
          'options' => ['class' => 'pagination ml20 mt10'],
        ],
        'summaryOptions' => [
          'class' => 'summary ml20 mr20 mt10 mb10',
        ],
        'layout'         => '{items}{pager}{summary}',
        'columns' => [
          [
              'attribute' => 'thumbnail',
              'format' => 'html',
              'value' => function ($model) {
                  return Html::img($model->thumbnail, ['class' => 'img-responsive']);
              },
           ],
          'text',
          [
              'attribute' => 'created_time',
              'value' => function ($model) {
                  return date('d-m-Y', $model->created_time);
              },
           ],
        ],
      ]); ?>
    </section>
  </div>
</div>
