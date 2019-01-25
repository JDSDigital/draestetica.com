<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Blog;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-lg-12">
    <section class="panel ml10 mr10">
      <header class="panel-heading">
        <?= Html::a('<i class="fa fa-plus mr5"></i>Crear Entrada', ['create'], ['class' => 'btn bg-success btn-xs']) ?>
      </header>

      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
              'attribute' => 'status',
              'format' => 'raw',
              'headerOptions' => ['style' => 'width:100px'],
              'value' => function ($model) {
                  $check = ($model->status == Blog::STATUS_ACTIVE) ? "checked='checked'" : null;
                  return "<div class='switchery-xs m0'>
                    <input id='status-$model->id' type='checkbox' class='switchery switchStatus' $check>
                  </div>";
              }
          ],
          [
              'attribute' => 'featured',
              'format' => 'raw',
              'headerOptions' => ['style' => 'width:100px'],
              'value' => function ($model) {
                  $check = ($model->featured == Blog::STATUS_ACTIVE) ? "checked='checked'" : null;
                  return "<div class='switchery-xs m0'>
                    <input id='featured-$model->id' type='checkbox' class='switchery switchStatus' $check>
                  </div>";
              }
          ],
          'tag_id',
          'title',
          'views',
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

          ['class' => 'yii\grid\ActionColumn'],
        ],
      ]); ?>
    </section>
  </div>
</div>
