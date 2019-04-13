<?php

namespace backend\modules\Usuarios\controllers;

use Yii;
use yii\helpers\Url;
use common\models\User;
use common\models\search\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsuariosController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save() && $model->upload()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
      $model = $this->findModel($id);

      $previews = [];
      $previewsConfig = [];

      if ($model->file !== null) {
          $previews[] = $model->getThumb();
          $previewsConfig[] = [
            'caption' => $model->file,
            'key' => $model->id,
            'url' => Url::to(["/Usuarios/usuarios/deleteimage?id=" . $model->id]),
          ];
      }

      if ($model->load(Yii::$app->request->post())) {

          if ($model->upload() && $model->save()) {
              return $this->redirect(['view', 'id' => $model->id]);
          }

      }

      return $this->render('update', [
          'model' => $model,
          'previews' => $previews,
          'previewsConfig' => $previewsConfig,
      ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionDelete($id)
     {
         $model = $this->findModel($id);

         if ($this->actionDeleteimage($id)) {
             $model->delete();
         }

         return $this->redirect(['index']);
     }

     /**
      * Deletes a single image
      * @param $id
      * @return bool
      */
     public function actionDeleteimage($id){

         return $this->findModel($id)->deleteImage();
     }

    /**
     * Changes Status.
     *
     * @return string
     */
    public function actionStatus()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $model = User::findOne($data['id']);

            if ($model->status)
                $model->status = User::STATUS_DELETED;
            else
                $model->status = User::STATUS_ACTIVE;

            $model->save();
        }

        return null;
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
