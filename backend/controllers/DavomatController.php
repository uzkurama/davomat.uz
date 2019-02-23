<?php

namespace backend\controllers;

use common\models\Attend;
use common\models\Group;
use common\models\Chair;
use common\models\Faculty;
use common\models\Student;
use common\models\Lesson;
use Yii;
use yii\filters\AccessControl;

class DavomatController extends \yii\web\Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
    	$this->enableCsrfValidation = false;
        return $this->render('index');
    }

}
