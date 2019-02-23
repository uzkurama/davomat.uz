<?php

namespace frontend\controllers;

use Yii;
use common\models\Attend;
use common\models\Faculty;
use common\models\Chair;
use common\models\Group;
use common\models\Student;
use common\models\Lesson;
use frontend\models\AttendSearch;
use frontend\models\StudentSearch;
use frontend\models\GroupSearch;
use frontend\models\ChairSearch;
use frontend\models\FacultySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AttendController implements the CRUD actions for Attend model.
 */
class AttendController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    /**
     * Darsga kelgan talabalar bilan jami talabalar farqi(foizda).
     * @return int
     */
    public function actionPara_foiz($fac, $cour, $smena, $lesson_id, $chair)
    {   

        $params = Yii::$app->request->queryParams;
        if($params[date] == null) {$params[date] = date('Y-m-d');}

        if($cour == "")
        {
            for ($i=1; $i <= 4; $i++) { 
                if(Attend::find()->where(['faculty_id' => $fac, 'lesson_id' => $lesson_id, 'shift_id' => $smena, 'attend' => 0, 'date' => $params[date]])->andWhere(['like', 'chair_id', $chair])->andWhere(['like', 'course_id', $i])->count() != 0 && Student::find()->where(['faculty_id' => $fac, 'shift_id' => $smena])->andWhere(['like', 'chair_id', $chair])->andWhere(['like', 'course_id', $i])->count() != 0)
                {
                    $course[$i]['percent'] = (Attend::find()->where(['faculty_id' => $fac, 'lesson_id' => $lesson_id, 'shift_id' => $smena, 'attend' => 0, 'date' => $params[date]])->andWhere(['like', 'chair_id', $chair])->andWhere(['like', 'course_id', $i])->count() / Student::find()->where(['faculty_id' => $fac, 'shift_id' => $smena])->andWhere(['like', 'chair_id', $chair])->andWhere(['like', 'course_id', $i])->count()) * 100;
                }
                else
                {
                    echo "";
                }
            }
            
            $courses = [$course[1], $course[2], $course[3], $course[4]];

            $childPers = array_column($courses, 'percent');

            if(count($childPers) != 0)
            {
                $parentItem['percent'] = array_sum($childPers)/(count($childPers));
                
                $sum_para1 = $parentItem['percent'];
            }
            else
            {
                echo "";
            }
        }
        else if($cour != "")
        {
            $para1 = Attend::find()->where(['faculty_id' => $fac, 'lesson_id' => $lesson_id, 'course_id' => $cour, 'shift_id' => $smena, 'attend' => 0, 'date' => $params[date]])->andWhere(['like', 'chair_id', $chair])->count();
        
            $fac_stud_count = Student::find()->where(['faculty_id' => $fac, 'course_id' => $cour, 'shift_id' => $smena])->andWhere(['like', 'chair_id', $chair])->count();

            if($fac_stud_count != 0)
            {
                $sum_para1 = $para1/$fac_stud_count *100;
            }
            else
            {
                echo "";
            }
        }
        else
        {
            echo "";
        }
    
        return $sum_para1;
    }

    /**
     * Talabalar soni hisobi.
     * @return int
     */
    public function actionStudentcount($fac, $cour, $smena, $chair)
    {   

        $fac_stud_count = Student::find()->where(['faculty_id' => $fac, 'shift_id' => $smena])->andWhere(['like', 'chair_id', $chair])->andWhere(['like', 'course_id', $cour])->count();

        return $fac_stud_count;
    }

    /**
     * Darsga kelganlar hisobi.
     * @return int
     */
    public function actionPara($fac, $cour, $smena, $lesson_id, $chair)
    {
        $params = Yii::$app->request->queryParams;
        if($params[date] == null) {$params[date] = date('Y-m-d');}

        $para1 = Attend::find()->where(['faculty_id' => $fac, 'lesson_id' => $lesson_id, 'shift_id' => $smena, 'attend' => 0, 'date' => $params[date]])->andWhere(['like', 'chair_id', $chair])->andWhere(['like', 'course_id', $cour])->count();


        return $para1;
    }

    /**
     * Guruh talabalar soni.
     * @return int
     */
    public function actionGroup_sum($chair, $group)
    {
        $group_count = Student::find()->where(['chair_id' => $chair, 'group_id' => $group])->count();

        return $group_count;
    }

    /**
     * Guruh talabalar davomati va jami davomati.
     * @return int
     */
    public function actionGroup_davomat($chair, $group, $lesson_id)
    {
        $params = Yii::$app->request->queryParams;
        if($params[date] == null) {$params[date] = date('Y-m-d');}
        $group_count_davomat = Attend::find()->where(['chair_id' => $chair, 'group_id' => $group, 'attend' => 0, 'lesson_id' => $lesson_id, 'date' => $params[date]])->count();

        return $group_count_davomat;
    }

    public function actionGroup_davomat_cause($chair, $group, $lesson_id, $cause)
    {
        $params = Yii::$app->request->queryParams;
        if($params[date] == null) {$params[date] = date('Y-m-d');}
        $group_count_davomat = Attend::find()->where(['chair_id' => $chair, 'group_id' => $group, 'attend' => 1, 'lesson_id' => $lesson_id, 'date' => $params[date], 'sababli' => $cause])->count();

        return $group_count_davomat;
    }
    /**
     * Guruh talabalar davomati farqi(foizda).
     * @return int
     */
    public function actionGroup_davomat_foiz($chair, $group, $lesson_id)
    {
        $params = Yii::$app->request->queryParams;
        if($params[date] == null) {$params[date] = date('Y-m-d');}
        $group_count_davomat = Attend::find()->where(['chair_id' => $chair, 'group_id' => $group, 'attend' => 0, 'lesson_id' => $lesson_id, 'date' => $params[date]])->count();

        $group_count = Student::find()->where(['chair_id' => $chair, 'group_id' => $group])->count();

        if($group_count != 0)
            {
                $foiz = $group_count_davomat/$group_count *100;
            }
        else
            {
                echo "";
            }

        return $foiz;
    }

    public function actionGroup_all_attend_cause($group, $chair)
    {
        $sababli = Attend::find()->where(['chair_id' => $chair, 'group_id' => $group, 'attend' => 1, 'sababli' => 1])->count();
        $group_count = Student::find()->where(['chair_id' => $chair, 'group_id' => $group])->count();
        if($sababli != 0)
            {
                return $sababli;
            }
        else
            {
                return "";
            }
    }

    public function actionGroup_all_attend_uncause($group, $chair)
    {
        $sababsiz = Attend::find()->where(['chair_id' => $chair, 'group_id' => $group, 'attend' => 1, 'sababli' => 0])->count();

        if($sababsiz != 0)
            {
                return $sababsiz;
            }
        else
            {
                return "";
            }
    }


    /**
     * Talaba para davomati.
     * @return int
     */
    public function actionTalaba_attend($group, $student, $lesson_id)
    {
        $params = Yii::$app->request->queryParams;
        if($params[date] == null) {$params[date] = date('Y-m-d');}
        if(Attend::find()->where(['group_id' => $group, 'student_id' => $student,'attend' => 1, 'lesson_id' => $lesson_id, 'date' => $params[date]])->count() == 1)
            {
                return '<i style="color: red" class="fas fa-times"></i>';
            }
        else if(Attend::find()->where(['group_id' => $group, 'student_id' => $student,'attend' => 0, 'lesson_id' => $lesson_id, 'date' => $params[date]])->count() == 1)
            {
                return '<i style="color: green" class="fas fa-check"></i>';
            }
        else
            {
                return "";
            }
    }

    /**
     * Talaba para davomati sababi.
     * @return int
     */
    public function actionTalaba_cause($group, $student, $lesson_id)
    {
        $params = Yii::$app->request->queryParams;
        if($params[date] == null) {$params[date] = date('Y-m-d');}
        if(Attend::find()->where(['group_id' => $group, 'student_id' => $student,'attend' => 1, 'sababli' => 1, 'lesson_id' => $lesson_id, 'date' => $params[date]])->count() == 1)
            {
                return '<i style="color: green" class="fas fa-check"></i>';
            }
        else if(Attend::find()->where(['group_id' => $group, 'student_id' => $student,'attend' => 1, 'sababli' => 0, 'lesson_id' => $lesson_id, 'date' => $params[date]])->count() == 1)
            {
                return '<i style="color: red" class="fas fa-times"></i>';
            }
        else
            {
                return "";
            }
    }


    /**
     * DeDrop actions.
     * @return json
     */
    public function actionChaircat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $faculty_id = $parents[0];
                $out = Attend::getChair($faculty_id); 
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
                $out = Attend::getGroup($faculty_id, $chair_id); 
                return json_encode(['output'=>$out, 'selected'=>'']);
                }
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Lists all Attend models.
     * @return mixed
     */
    public function actionIndex()
    {   
        if(Yii::$app->user->identity->faculty_id == null){
            $searchModel = new AttendSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        else
        {
            if(Yii::$app->request->queryParams != null && Yii::$app->request->queryParams[faculty_id] != Yii::$app->user->identity->faculty_id){
                Yii::$app->getSession()->setFlash('error', 'Sizda boshqa fakultetning davomatini ko\'rishga huquqiz yoq!');
                return $this->redirect('i');
            }
            else
            {
                $searchModel = new AttendSearch();
                $searchModel->faculty_id = Yii::$app->user->identity->faculty_id;
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            }
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFaculty()
    {   
        if(Yii::$app->user->identity->faculty_id == null){
            $searchModel = new FacultySearch();
            $searchModel2 = new AttendSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        else
        {
            $searchModel = new FacultySearch();
            $searchModel->id = Yii::$app->user->identity->faculty_id;
            $searchModel2 = new AttendSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        return $this->render('faculty', [
            'searchModel' => $searchModel,
            'searchModel2' => $searchModel2,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChair($id, $s)
    {   
        $searchModel2 = new AttendSearch();
        $smena = $s; 
        $faculty_name = Faculty::find()->where(['id' => $id])->select('name')->one(); 
        $searchModel = new ChairSearch();
        $searchModel->faculty_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('chair', [
            'searchModel' => $searchModel,
            'searchModel2' => $searchModel2,
            'dataProvider' => $dataProvider,
            'faculty_name' => $faculty_name,
            'smena' => $smena,
        ]);
    }

    public function actionGroup($id, $s)
    {   
        $smena = $s;
        $searchModel2 = new AttendSearch();
        $chair_name = Chair::find()->where(['id' => $id])->select('name')->one();
        $searchModel = new GroupSearch();
        $searchModel->chair_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('group', [
            'searchModel' => $searchModel,
            'searchModel2' => $searchModel2,
            'dataProvider' => $dataProvider,
            'chair_name' => $chair_name,
            'smena' => $smena,
        ]);
    }

    public function actionStudent($id, $s)
    {   
        $smena = $s;
        $searchModel2 = new AttendSearch();
        $group_name = Group::find()->where(['id' => $id])->select('name')->one();
        $searchModel = new StudentSearch();
        $searchModel->group_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('student', [
            'searchModel' => $searchModel,
            'searchModel2' => $searchModel2,
            'dataProvider' => $dataProvider,
            'group_name' => $group_name,
            'smena' => $smena,
        ]);
    }

    public function actionView($id)
    {
        $searchModel = new AttendSearch();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Finds the Attend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attend the loaded model
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
