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

    /**
     * Returns an array with the days that the clinic is open for business
     */
    public function actionWorkingdays(): array
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            return Appointments::WORKING_DAYS;
        }
        
        return null;
    }

    /**
     * Returns an array of the days that are already full of appointments
     */
    public function actionBookeddays(): array
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            return Appointments::getBookedDays($request->post('date'));
        }
        
        return null;
    }

    /**
     * Returns an array with the hours that the clinic is open for business
     */
    public function actionWorkinghours(): array
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            return Appointments::WORKING_HOURS;
        }
        
        return null;
    }

    /**
     * Returns an array of the hours of a day that are already booked
     */
    public function actionBookedhours(): array
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            return Appointments::getBookedHoursByDate($request->post('date'));
        }
        
        return null;
    }

    /**
     * Saves a new appointment
     */
    public function actionCreateappointment(): bool
    {
        $request = Yii::$app->request;

        if ($request->isPost) { 
            $appointment = new Appointments;
            $appointment->client_id = $request->post('userId');
            $appointment->service_id = $request->post('serviceId');
            $appointment->date = str_replace('T', ' ',  $request->post('date'));
            $appointment->status = Appointments::STATUS_ACTIVE;

            return ($appointment->save()) ? true : false;
        }
        
        return null;
        // return date("Y-m-d H:i:s");
        // $date = new DateTime('2000-01-01');
        // echo $date->format('Y-m-d H:i:s');
    }

}
