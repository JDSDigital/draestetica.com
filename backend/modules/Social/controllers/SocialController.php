<?php

namespace backend\modules\Social\controllers;

use Yii;
use yii\helpers\Url;
use common\models\Social;
use common\models\Images;
use common\models\search\SocialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SocialController implements the CRUD actions for Social model.
 */
class SocialController extends Controller
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
        $searchModel = new SocialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

    /**
     * Creates a new Social model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Social();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {

              $model->upload();

              return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Social model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $uploadedImages = Images::find()->where(['article_id' => $id])->all();

        $previews = [];
        $previewsConfig = [];

        foreach ($uploadedImages as $image){
            $previews[] = $image->getThumb();

            $previewsConfig[] = [
              'caption' => $image->file,
              'key' => $image->id,
              'url' => Url::to(["/Social/social/deleteimage?id=" . $image->id]),
            ];
        }

        if ($model->load(Yii::$app->request->post())) {

          if ($model->save()) {

            $model->upload();

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
     * Deletes an existing Social model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionDelete($id)
     {
         $model = $this->findModel($id);
         $images = Images::find()->where(['article_id' => $id])->all();

         foreach ($images as $image) {
            $this->actionDeleteimage($image->id);
         }

         $model->delete();

         return $this->redirect(['index']);
     }

     /**
      * Deletes a single image
      * @param $id
      * @return bool
      */
     public function actionDeleteimage($id){

         $image = Images::findOne($id);

         $article_id = $image->article_id;

         $url = Url::to('@frontend/web/img/social/') . $image->file;
         $urlThumb = Url::to('@frontend/web/img/social/thumbs/') . $image->file;

         // Delete image from the database and the folder
         if (unlink($url) && unlink($urlThumb) && $image->delete())
             return true;
         else
             return false;
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

             $model = Social::findOne($data['id']);

             if ($model->status)
                 $model->status = Social::STATUS_DELETED;
             else
                 $model->status = Social::STATUS_ACTIVE;

             $model->save();
         }

         return null;
     }

     /**
      * Changes Featured Status.
      *
      * @return string
      */
     public function actionFeatured()
     {
         if (Yii::$app->request->isAjax) {
             $data = Yii::$app->request->post();

             $model = Social::findOne($data['id']);

             if ($model->featured)
                 $model->featured = Social::STATUS_DELETED;
             else
                 $model->featured = Social::STATUS_ACTIVE;

             $model->save();
         }

         return null;
     }

     /**
      * Sets Cover image.
      *
      * @return string
      */
     public function actionCover()
     {
       if (Yii::$app->request->isAjax) {
           $data = Yii::$app->request->post();

           $model = Images::findOne($data['id']);

           return $model->setCover();
       }

       return null;
     }

    /**
     * Finds the Social model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Social the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Social::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
