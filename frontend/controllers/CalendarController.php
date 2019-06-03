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

    /* public function actionAvailabledays()
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
    } */

    /**
     * lo que actualmente tienes como availableDays, es un array que indica los días en que se trabaja: [0,1,1,1,1,1,0]
     */
    public function actionWorkingDays(): array
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            return [0, 1, 1, 1, 1, 1, 0];
        }
        
        return null;
    }

    /**
     * array de los días de un mes que están llenos (lo que tu llamas unavailable day)
     */
    public function actionBookedDays(): array
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

    /**
     * array de las horas en las que un servicio se presta [8,9,10,11,12,14,15,16]
     */
    public function actionWorkingHours(): array
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            return [8, 9, 10, 11, 12, 14, 15, 16];
        }
        
        return null;
    }

    /**
     * array de las horas de un determinado día que ya están tomadas: [10,16]
     */
    public function actionBookedHours(): array
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            return Appointments::getBookedHoursByDate($request->post('date'));
        }
        
        return null;
    }

    /**
     * guarda la fecha de la cita
     */
    public function actionCreateAppointment(): bool
    {
        $request = Yii::$app->request;

        if ($request->isPost) { 
            $appointment = new Appointments;
            $appointment->client_id = $request->post('userId');
            $appointment->service_id = $request->post('serviceId');
            $appointment->date = $request->post('dateTime');
            $appointment->status = Appointments::STATUS_ACTIVE;

            return ($appointment->save()) ? true : false;
        }
        
        return null;
        // return date("Y-m-d H:i:s");
        // $date = new DateTime('2000-01-01');
        // echo $date->format('Y-m-d H:i:s');
    }

}
