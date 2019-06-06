<?php

namespace frontend\controllers;

use common\models\Appointments;
use Yii;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class CalendarController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\Clients';

    public function behaviors()
    {
        return [
            'content' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'verbs' => ['POST']
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'workingdays', 
                            'workinghours', 
                            'bookeddays', 
                            'bookedhours', 
                            'createappointment'
                        ],
                    ],
                ],
                // 'denyCallback' => function ($rule, $action) {
                //     return $this->redirect(['//site/login']);
                // }
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
        
        return [];
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
        
        return [];
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
        
        return [];
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
        
        return [];
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
        
        return false;
    }

}
