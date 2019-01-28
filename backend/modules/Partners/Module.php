<?php

namespace backend\modules\Partners;

/**
 * Partners module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\Partners\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $logosFolder = Yii::getAlias('@frontend').'\web\img\logos';

        if (!file_exists($logosFolder)) {
            mkdir($logosFolder, 0755);
        }
    }
}