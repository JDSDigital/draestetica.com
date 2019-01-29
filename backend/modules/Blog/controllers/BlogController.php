<?php

namespace backend\modules\Blog\controllers;

use Yii;
use common\models\Blog;
use common\models\search\BlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
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
        ];
    }

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
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
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blog();

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
     * Updates an existing Partners model.
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
              'url' => Url::to(["/Blog/blog/deleteimage?id=" . $model->id]),
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
     * Deletes an existing Blog model.
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

            $model = Blog::findOne($data['id']);

            if ($model->status)
                $model->status = Blog::STATUS_DELETED;
            else
                $model->status = Blog::STATUS_ACTIVE;

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

            $model = Blog::findOne($data['id']);

            if ($model->featured)
                $model->featured = Blog::STATUS_DELETED;
            else
                $model->featured = Blog::STATUS_ACTIVE;

            $model->save();
        }

        return null;
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
