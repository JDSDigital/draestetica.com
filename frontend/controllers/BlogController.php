<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Tags;
use common\models\Blog;
use common\models\search\BlogSearch;

/**
 * Blog controller
 */
class BlogController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $propertiesSearch = new BlogSearch;

        if (isset(Yii::$app->request->post()['tag_id'])) {
            $dataProvider = $propertiesSearch->tag(Yii::$app->request->post()['tag_id']);
        } else {
            $dataProvider = $propertiesSearch->search(Yii::$app->request->post());
        }

        $tags = Tags::getList();
        $latest = Blog::getLatest();

        return $this->render('index', [
            'propertiesSearch' => $propertiesSearch,
            'dataProvider' => $dataProvider,
            'tags' => $tags,
            'latest' => $latest,
        ]);
    }

    public function actionView($id)
    {
        $propertiesSearch = new BlogSearch;

        $article = $this->findModel($id);
        $tags = Tags::getList();
        $latest = Blog::getLatest();

        $article->updateCounters(['views' => 1]);

        return $this->render('view', [
            'propertiesSearch' => $propertiesSearch,
            'article' => $article,
            'tags' => $tags,
            'latest' => $latest,
        ]);
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
