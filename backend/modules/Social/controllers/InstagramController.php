<?php

namespace backend\modules\Social\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Instagram;
use common\models\AccessCodes;

/**
 * SocialController implements the CRUD actions for Social model.
 */
class InstagramController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Social models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Instagram::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates models from instagram
     * @return mixed
     */
    public function actionUpdate()
    {
        if (Instagram::updateInstagramPhotos()) {
            return $this->redirect('index');
        } else {
            return $this->redirect(Instagram::getApiAuthUrl());
        }
    }

    /**
     * Displays a single Social model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAuth()
    {
        if (Yii::$app->request->get('code')) {
            $access_code = Instagram::requestAccessToken(Yii::$app->request->get('code'));

            if ($access_code['access_token']) {
                $model = AccessCodes::find()->where(['id' => 1])->one();
                $model->access_token = $access_code['access_token'];
                $model->save();

                return $this->redirect('update');
            }

        }

        return $this->redirect('index');
    }

    /**
     * Finds the Social model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Instagram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Instagram::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
