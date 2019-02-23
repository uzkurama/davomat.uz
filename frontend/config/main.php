<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language' => 'uz',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'attend/faculty',
    'components' => [
        'assetManager' => [
            'converter' => 'lucidtaz\yii2scssphp\ScssAssetConverter',
        ],
        'request' => [
            'enableCsrfValidation' => false,
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
                'a/i'=>'attend/index',
                'a/v'=>'attend/view',
                'a/f'=>'attend/faculty',
                'a/c'=>'attend/chair',
                'a/g'=>'attend/group',
                'a/s'=>'attend/student',
                's/s'=>'site/search_cat',
                's/i'=>'student/index',
            ],
        ],
        
    ],
    'params' => $params,
];
