<?php
 
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
 
/* @var $this yii\web\View */
/* @var $searchModel app\modules\notes\models\NotesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
 
$this->title = "Davomat qo'shish";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="davomat-index">
 
    <h1><?= Html::encode($this->title) ?></h1>
 
    <?= $this->render('_form',[
        'model' => $model,
    ]) ?>
 
</div>