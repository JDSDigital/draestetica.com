<?php

namespace backend\modules\Clinic\controllers;

use Yii;
use yii\helpers\Url;
use common\models\ClinicServices;
use common\models\ClinicServicesImages;
use common\models\search\ClinicServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ServiciosController implements the CRUD actions for ClinicServices model.
 */
class ServiciosController extends Controller
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
     * Lists all ClinicServices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClinicServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTest()
    {
        foreach ($models as $service) {
            # code...
            $image = new ClinicServicesImages;
            $image->service_id = $service->id;
            $image->file = $service->file;
            $image->cover = 1;
            $image->save();
        }
    }

    /**
     * Displays a single ClinicServices model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $models = ClinicServices::find()->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ClinicServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClinicServices();

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
     * Updates an existing ClinicServices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $uploadedImages = ClinicServicesImages::find()->where(['service_id' => $id])->all();

        $previews = [];
        $previewsConfig = [];

        foreach ($uploadedImages as $image){
            $previews[] = $image->getThumb();

            $previewsConfig[] = [
              'caption' => $image->file,
              'key' => $image->id,
              'url' => Url::to(["/Clinic/servicios/deleteimage?id=" . $image->id]),
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
     * Deletes an existing ClinicServices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $images = ClinicServicesImages::find()->where(['service_id' => $id])->all();

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

        $service_id = $image->service_id;

        $url = Url::to('@frontend/web/img/clinic/services/') . $image->file;
        $urlThumb = Url::to('@frontend/web/img/clinic/services/thumbs/') . $image->file;

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

            $model = ClinicServices::findOne($data['id']);

            if ($model->status)
                $model->status = ClinicServices::STATUS_DELETED;
            else
                $model->status = ClinicServices::STATUS_ACTIVE;

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

            $model = ClinicServicesImages::findOne($data['id']);

            return $model->setCover();
        }

        return null;
    }

    /**
     * Finds the ClinicServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClinicServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClinicServices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
