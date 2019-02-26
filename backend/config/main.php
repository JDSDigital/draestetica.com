<?php

use \yii\web\Request;
$baseUrl = str_replace('/backend/web', '/admin', (new Request)->getBaseUrl());

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'language' => 'es_ES',
    'name' => 'Dra. Estetica',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'Usuarios' => [
            'class' => 'backend\modules\Usuarios\Module',
            'defaultRoute' => 'usuarios',
        ],
        'Partners' => [
            'class' => 'backend\modules\Partners\Module',
            'defaultRoute' => 'partners',
        ],
        'Blog' => [
            'class' => 'backend\modules\Blog\Module',
        ],
        'Social' => [
            'class' => 'backend\modules\Social\Module',
            'defaultRoute' => 'social',
        ],
        'Clinic' => [
            'class' => 'backend\modules\Clinic\Module',
            // 'defaultRoute' => 'servicios',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => $baseUrl,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'draestetica-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
