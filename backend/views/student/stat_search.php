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

    <div class="col-md-7">
        <?= $form->field($model, 'date')->dropDownList([date('Y')."-"."01" => 'Yanvar', date('Y')."-"."02" => 'Fevral', date('Y')."-"."03" => 'Mart', date('Y')."-"."04" => 'Aprel', date('Y')."-"."05" => 'May', date('Y')."-"."06" => 'Iyun', date('Y')."-"."07" => 'Iyul', date('Y')."-"."08" => 'Avgust', date('Y')."-"."09" => 'Sentabr', date('Y')."-"."10" => 'Oktabr', date('Y')."-"."11" => 'Noyabr', date('Y')."-"."12" => 'Dekabr'],['prompt'=>'Oyni tanlang']);?>
    </div>
    <div style="margin-top: 20px;" class="col-md-2">
        <div class="form-group">
            <?= Html::submitButton('Tanlash', ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>