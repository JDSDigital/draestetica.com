<?php

namespace frontend\modules\clientes\controllers;

use Yii;
use common\models\Clients;
use common\models\search\ClinicServicesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PanelController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['index', 'update'],
                'rules' => [
                    [
                        // 'actions' => ['index', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect(['//site/login']);
                }
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpdate()
    {
        $model = $this->findModel();

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionCitas()
    {
        $clinicServicesSearch = new ClinicServicesSearch;
        $models = $clinicServicesSearch->frontendServices();

        return $this->render('services', [
            'models' => $models,
        ]);
    }

    public function actionAgendar()
    {
        return $this->render('book');
    }
    
    /**
     * @return Clients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel()
    {
        if (($model = Yii::$app->user->identity) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
