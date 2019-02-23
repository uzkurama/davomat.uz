<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Attend;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\AttendSearch */
/* @var $form yii\widgets\ActiveForm */ 

?>
<?php $form = ActiveForm::begin([
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
<div class="col-md-4">
    <?= $form->field($model, 'date')->widget(
        DatePicker::className(), [
        'type' => 1,
        'removeButton' => false,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
        ]);
    ?>
</div>
<div class="col-md-2">
    <?= Html::submitButton('Tanlash', ['class' => 'btn btn-round btn-fill btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
 