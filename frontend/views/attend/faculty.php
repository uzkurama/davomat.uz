<?php

use common\models\Attend;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AttendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Navoiy Konchilik Instituti davomati';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="attend-index">
<?php  Pjax::begin(['enablePushState' => true]); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <?php  echo $this->render('_search2', ['model' => $searchModel2]); ?>
                            <div class="col-md-2">
                                <button id="printBtn" class="btn btn-round btn-fill btn-primary" onclick="javascript:print();">Chop etish</button>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="card">
        <div class="card-header" data-background-color="orange">
            <h4 class="title"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="col-md-6">
        <div class="card-content table-responsive">
            <table class="table table-hover">
                <thead class="text-warning">
                    <th colspan="12" style="text-align: center;">1-smena</th>
                </thead>
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
                            'itemView' => '_1smena',
                            'summary'=>'',
                ]) ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-content table-responsive">
            <table class="table table-hover">
                <thead style="text-align: center;" class="text-warning">
                    <th colspan="12" style="text-align: center;">2-smena</th>
                </thead>
                <thead style="text-align: center;" class="text-warning">
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
                            'itemView' => '_2smena',
                            'summary'=>'',
                ]) ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
  <?php Pjax::end(); ?>
</div>
