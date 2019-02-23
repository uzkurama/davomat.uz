<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Attend;
use kartik\depdrop\DepDrop;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Attend */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attend-form">
    <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'faculty_id')->dropDownList(Attend::getFaculty(), ['prompt' => 'Fakultetni tanlang', 'id' => 'cat-id']) ?>

    <?= $form->field($model, 'chair_id')->widget(DepDrop::classname(), [
        'options'=>['id'=>'subcat-id', 'prompt' => 'Kafedrani tanlang'],
        'pluginOptions'=>[
            'depends'=>['cat-id'],
            'placeholder' => 'Kafedrani tanlang',
            'url'=>Url::to(['/attend/chaircat'])
        ]
    ]); ?>

    <?= $form->field($model, 'group_id')->widget(DepDrop::classname(), [
        'pluginOptions'=>[
            'depends'=>['cat-id', 'subcat-id'],
            'placeholder'=>'Guruhni tanlang',
            'url'=>Url::to(['/attend/groupcat'])
        ]
    ]); ?>

    <?= $form->field($model, 'lesson_id')->dropDownList(Attend::getLesson(), ['prompt' => 'Parani tanlang']) ?>

            

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
