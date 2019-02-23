<?php

namespace backend\controllers;

use Yii;
use common\models\Student;
use common\models\Group;
use backend\models\StudentSearch;
use frontend\models\AttendSearch;
use yii\web\Controller;
use yii\db\Query;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
                        'actions' => ['logout', 'index','view','create','update','delete','grouplist','chaircat','groupcat'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionGrouplist($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, name AS text')
                ->from('group')
                ->where(['like', 'name', $q])->andWhere(['faculty_id' => Yii::$app->user->identity->faculty_id])
                ->limit(10);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Group::find($id)->name];
        }
        return $out;
    }


    public function actionChaircat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $faculty_id = $parents[0];
                $out = Student::getChair($faculty_id); 
                return json_encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }

    public function actionGroupcat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if (!empty($parents)) {
                $faculty_id = (!empty($parents[0])) ? $parents[0] : null;
                $chair_id = (!empty($parents[1])) ? $parents[1] : null;
                
                if ($faculty_id !== null && $chair_id !== null) {
                $out = Group::getGroup($faculty_id, $chair_id); 
                return json_encode(['output'=>$out, 'selected'=>'']);
                }
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }

    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $searchModel->faculty_id = Yii::$app->user->identity->faculty_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new AttendSearch();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        if ($model->load(Yii::$app->request->post())) {

            $model->course_id = $model->group_details->course;
            $model->shift_id = $model->group_details->shift;
            $model->faculty_id = Yii::$app->user->identity->faculty;
            if(UploadedFile::getInstance($model, 'imgFile') != null)
            {
                $imageName = uniqid();
                $model->image = UploadedFile::getInstance($model, 'imgFile');
                $model->image->saveAs('students/'.$imageName.'.'.$model->image->extension);
                $model->image ='students/'.$imageName.'.'.$model->image->extension;
            }
            else
            {
                $model->image ='img/no_photo.png';
            }
            
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->course_id = $model->group_details->course_id;
            $model->shift_id = $model->group_details->shift_id;
            $model->faculty_id = Yii::$app->user->identity->faculty_id;
            if(UploadedFile::getInstance($model, 'imgFile') != null)
            {
                $imageName = uniqid();
                $model->image = UploadedFile::getInstance($model, 'imgFile');
                $model->image->saveAs('students/'.$imageName.'.'.$model->image->extension);
                $model->image ='students/'.$imageName.'.'.$model->image->extension;
            }
            else if($model->image == null)
            {
                $model->image ='img/no_photo.png';
            }
            else
            {
                $model->image = $model->image;
            }
            
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
