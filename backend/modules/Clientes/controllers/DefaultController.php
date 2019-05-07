<?php

namespace backend\modules\Clients\controllers;

use yii\web\Controller;

/**
 * Default controller for the `Clients` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
