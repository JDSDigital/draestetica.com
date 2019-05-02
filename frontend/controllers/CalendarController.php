<?php

namespace frontend\controllers;

use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class CalendarController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionAvailabledays()
    {
        // Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [0, 1, 1, 1, 1, 1, 0];
    }

    public function actionAvailablehours()
    {
        // Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 1,
            9 => 1,
            10 => 1,
            11 => 1,
            12 => 1,
            13 => 1,
            14 => 1,
            15 => 1,
            16 => 1,
            17 => 1,
            18 => 1,
            19 => 0,
            20 => 0,
            21 => 0,
            22 => 0,
            23 => 0,
        ];
    }

}
