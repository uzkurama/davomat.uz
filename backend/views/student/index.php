<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Talabalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="card">
        <div class="card-content">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php Pjax::begin(); ?>
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Talaba kiritish', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'faculties.name:text:Fakulteti',
                    'chairs.name:text:Yo\'nalishi',
                    'group_details.name:text:Guruhi',
                    'shift_id',
                    'course_id',
                    'phone_number',
                    [
                        'label' => 'Rasm',
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::img(Url::toRoute($data->image),[
                                'alt'=> 'Talaba rasmi',
                                'style' => 'width:80px;'
                            ]);
                        },
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
