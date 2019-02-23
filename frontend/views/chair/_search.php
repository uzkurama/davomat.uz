<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Student;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model frontend\models\ChairSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chair-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'faculty_id')->dropDownList(Student::getFaculty(), ['prompt' => 'Fakultetni tanlang', 'id' => 'cat-id']) ?>

    <?= $form->field($model, 'chair_id')->widget(DepDrop::classname(), [
        'options'=>['id'=>'subcat-id', 'prompt' => 'Kafedrani tanlang'],
        'pluginOptions'=>[
            'depends'=>['cat-id'],
            'placeholder' => 'Kafedrani tanlang',
            'url'=>Url::to(['/student/chaircat'])
        ]
    ]); ?>

    <?= $form->field($model, 'faculty_id', ['inputOptions' => ['name' => 'fac']]) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
