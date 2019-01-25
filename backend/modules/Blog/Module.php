<?php

namespace backend\modules\Blog;

use Yii;

/**
 * Blog module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\Blog\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $blogFolder = Yii::getAlias('@frontend').'\web\img\blog';
        $thumbsFolder = $blogFolder . '\thumbs';

        if (!file_exists($blogFolder)) {
          mkdir($blogFolder, 0755);
          mkdir($thumbsFolder, 0755);
        }
    }
}
