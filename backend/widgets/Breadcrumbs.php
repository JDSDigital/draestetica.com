<?php

namespace backend\widgets;

use Yii;
use yii\widgets\Breadcrumbs as OldBreadcrumbs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Breadcrumbs extends OldBreadcrumbs
{
  public $options = ['class' => 'breadcrumb'];
  public $itemTemplate = "<li>{link}</li>\n";
  public $activeItemTemplate = "<li class=\"active\">{link}</li>\n";

  public function run()
  {
    if (empty($this->links)) {
        return;
    }
    echo '<div class="page-header page-header-default">';
    $this->renderHeader();
    echo '<div class="breadcrumb-line">';
    parent::run();
    echo '</div></div>';
  }

  public function renderHeader()
  {
    echo '<div class="page-header-content"><div class="page-title">';
		echo '<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">' . strtoupper(Yii::$app->controller->id) . '</span> - ' . Yii::$app->view->title . '</h4>';
		echo '</div></div>';
  }

  protected function renderItem($link, $template)
  {
      $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);
      if (array_key_exists('label', $link)) {
          $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
      } else {
          throw new InvalidConfigException('The "label" element is required for each link.');
      }
      if (isset($link['template'])) {
          $template = $link['template'];
      }
      if (isset($link['url'])) {
          $options = $link;
          unset($options['template'], $options['label'], $options['url']);
          $link = Html::a($label, $link['url'], ['class' => 'g-color-white-opacity-0_8 g-color-white--hover']);
      } else {
          $link = $label;
      }

      return strtr($template, ['{link}' => $link]);
  }
}
/*
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
		</div>

		<div class="heading-elements">
			<div class="heading-btn-group">
				<a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
				<a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
				<a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
			</div>
		</div>
	</div>

	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ul>

		<ul class="breadcrumb-elements">
			<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-gear position-left"></i>
					Settings
					<span class="caret"></span>
				</a>

				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
					<li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
					<li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
					<li class="divider"></li>
					<li><a href="#"><i class="icon-gear"></i> All settings</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
*/
?>
