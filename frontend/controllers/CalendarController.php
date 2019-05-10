<?php

namespace frontend\controllers;

use common\models\Appointments;
use Yii;
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

    public function actionAppointmentsbymonth()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            return Appointments::find()
                ->byDateRange(
                    $request->post('startDate'), 
                    $request->post('finalDate')
                )->all();
        }
        
        return null;
    }

    public function actionSaveappointment()
    {
        $request = Yii::$app->request;

        if ($request->isPost) { 
            $appointment = new Appointments;
            $appointment->client_id = $request->post('userId');
            $appointment->date = $request->post('dateTime');
            $appointment->status = Appointments::STATUS_ACTIVE;

            return ($appointment->save()) ? true : false;
        }
        
        return null;
    }

}
