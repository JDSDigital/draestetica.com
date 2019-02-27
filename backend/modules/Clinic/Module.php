<?php

namespace backend\modules\Clinic;

use Yii;

/**
 * Clinic module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\Clinic\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        // $clinicFolder = Yii::getAlias('@frontend').'\web\img\clinic';
        // $servicesFolder = $clinicFolder . '\services';
        // $thumbsFolder = $servicesFolder . '\thumbs';
        //
        // if (!file_exists($clinicFolder)) {
        //   mkdir($clinicFolder, 0755);
        //   mkdir($servicesFolder, 0755);
        //   mkdir($thumbsFolder, 0755);
        // }
    }
}
