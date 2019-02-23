<?php

use common\models\Attend;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AttendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $faculty_name->name." davomati";
$this->params['breadcrumbs'][] = $this->title;
$s = [$smena];
?>
<div class="attend-index">

    <?php  Pjax::begin(['enablePushState' => true]); ?>
    <?php  echo $this->render('_search2', ['model' => $searchModel2]); ?>
 <div class="col-md-12">
    <div class="card">
        <div class="card-header" data-background-color="orange">
            <h4 class="title"><?= Html::encode($this->title) ?></h4><span>Smena-<?= $smena?></span>
        </div>
        
        <div class="card-content table-responsive">
            <table class="table table-hover">
                <thead class="text-warning">
                    <th style="text-align: center;">Fakultet</th>
                    <th style="text-align: center;">Kurslar</th>
                    <th style="text-align: center;">Talabalar soni</th>
                    <th style="text-align: center;">1-para</th>
                    <th style="text-align: center;">Foizda</th>
                    <th style="text-align: center;">2-para</th>
                    <th style="text-align: center;">Foizda</th>
                    <th style="text-align: center;">3-para</th>
                    <th style="text-align: center;">Foizda</th>
                    <th style="text-align: center;">4-para</th>
                    <th style="text-align: center;">Foizda</th>
                    <th style="text-align: center;">Jami foizda</th>
                </thead>
                <tbody>
            <?= ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView' => '_chair',
                            'summary'=>'',
                ]) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>   
    <?php Pjax::end(); ?>
</div>
