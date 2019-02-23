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
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'faculty_id')->dropDownList(Attend::getFaculty(), ['prompt' => 'Fakultetni tanlang', 'id' => 'cat-id']); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'chair_id')->widget(DepDrop::classname(), [
                'options'=>['id'=>'subcat-id', 'prompt' => 'Kafedrani tanlang'],
                'pluginOptions'=>[
                    'depends'=>['cat-id'],
                    'placeholder' => 'Kafedrani tanlang',
                    'url'=>Url::to(['/attend/chaircat'])
                ]
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'group_id')->widget(DepDrop::classname(), [
                'pluginOptions'=>[
                    'depends'=>['cat-id', 'subcat-id'],
                    'placeholder'=>'Guruhni tanlang',
                    'url'=>Url::to(['/attend/groupcat'])
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'date')->widget(
                    DatePicker::className(), [
                    'type' => 1,
                    'removeButton' => false,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ],
            ]);?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'lesson_id')->dropDownList(Attend::getLesson(), ['prompt' => 'Parani tanlang']); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Qidirish', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
