<?php

namespace frontend\widgets;

use Yii;
use yii\widgets\Breadcrumbs as OldBreadcrumbs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Breadcrumbs extends OldBreadcrumbs
{
  public $options = ['class' => 'u-list-inline'];
  public $itemTemplate = "<li class=\"list-inline-item g-mr-7\">{link}<i class=\"fa fa-angle-right g-ml-7\"></i></li>\n";
  public $activeItemTemplate = "<li class=\"list-inline-item active\">{link}</li>\n";

  public function run()
  {
    if (empty($this->links)) {
        return;
    }
    echo '<section class="bg-theme-gradient-v1 g-color-white g-py-50 g-mb-20"><div class="container g-bg-cover__inner">';
    $this->renderHeader();
    parent::run();
    echo '</div></section>';
  }

  public function renderHeader()
  {
    echo '<header class="g-mb-20">';
    if (Yii::$app->controller->action->id != 'index') {
      echo '<h3 class="h5 g-font-weight-300 g-mb-5">' . ucfirst(Yii::$app->controller->id) . '</h3>';
      echo '<h2 class="h1 g-font-weight-300 text-uppercase">' . strtoupper(Yii::$app->controller->id) . '</h2>';
    } else {
      echo '<h2 class="h1 g-font-weight-300 text-uppercase">' . strtoupper(Yii::$app->view->title) . '</h2>';
    }
    echo '</header>';
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
          $link = Html::a($label, $link['url'], ['class' => 'g-color-white g-color-primary--hover']);
      } else {
          $link = $label;
      }

      return strtr($template, ['{link}' => $link]);
  }
}
/*
<section class="g-bg-gray-dark-v1 g-color-white g-py-50 g-mb-20">
  <div class="container g-bg-cover__inner">
    <header class="g-mb-20">
      <h3 class="h5 g-font-weight-300 g-mb-5">Breadcrumbs</h3>
      <h2 class="h1 g-font-weight-300 text-uppercase">Maecenas
        <span class="g-color-primary">enim</span>
        sapien
      </h2>
    </header>

    <ul class="u-list-inline">
      <li class="list-inline-item g-mr-7">
        <a class="u-link-v5 g-color-white g-color-primary--hover" href="#">Home</a>
        <i class="fa fa-angle-right g-ml-7"></i>
      </li>
      <li class="list-inline-item g-mr-7">
        <a class="u-link-v5 g-color-white g-color-primary--hover" href="#">Pages</a>
        <i class="fa fa-angle-right g-ml-7"></i>
      </li>
      <li class="list-inline-item g-color-primary">
        <span>About Us</span>
      </li>
    </ul>
  </div>
</section>
*/
?>
