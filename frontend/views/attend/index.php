<?php

use common\models\Attend;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AttendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qidirish';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="col-md-12">
<div class="row">
    <div class="card">
        <div class="card-content">

            <h2><?= Html::encode($this->title) ?></h2>
            
            <?php Pjax::begin(['enablePushState' => true]); ?>
            <?php if( Yii::$app->session->hasFlash('error') ): ?>
             <div class="alert alert-danger">
                <span><?php echo Yii::$app->session->getFlash('error'); ?></span>
             </div>
            <?php endif;?>
            <?= $this->render('_search', ['model' => $searchModel]); ?>

            <?php if(Yii::$app->request->queryParams != null) {?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => '',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'student_id' => [
                                'label' => 'Talaba',
                                'value' => function ($model, $index, $widget) {
                                    return $model->student->name;
                                },
                            ],
                    'chair_id' => [
                                'label' => 'Yo\'nalishi',
                                'value' => function ($model, $index, $widget) {
                                    return $model->chairs->name;
                                },
                            ],
                    'group_id' => [
                                'label' => 'Guruhi',
                                'value' => function ($model, $index, $widget) {
                                    return $model->groups->name;
                                },
                            ],
                    'lesson_id',
                    'attend' => [
                                'label' => 'Davomati',
                                'value' => function ($model, $index, $widget) {
                                    if($model->attend == 1){
                                        $model->attend = "Kelmagan";
                                    }
                                    else if ($model->attend == 0){
                                        $model->attend = "Kelgan";
                                    }
                                    return $model->attend;
                                },
                            ],
                ],
            ]); ?>
            <?php }?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
</div>