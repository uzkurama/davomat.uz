<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ChairSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Energo-Mexanika Fakulteti';
?>


<div class="chair-index">
    
    <?php Pjax::begin(); ?>
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col-md-12">
    <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_view',
                    'summary'=>'',
    ]) ?>
    </div>
</div>
    <?php Pjax::end(); ?>
</div>
