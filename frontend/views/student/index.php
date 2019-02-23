<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Talaba qidirish';
?>
<div class="student-index">
            <?php if( Yii::$app->session->hasFlash('error') ): ?>
             <div class="alert alert-danger">
                <span><?php echo Yii::$app->session->getFlash('error'); ?></span>
             </div>
            <?php endif;?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="container-fluid">
        <?php if(Yii::$app->request->queryParams != null){?>
            <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_view',
                        'summary'=>'',
            ]) ?>
        <?php }?>
    </div>
</div>
