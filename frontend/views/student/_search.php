<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Attend;
use common\models\Student;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\StudentSearch */
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
    <div id="search1" class="col-md-6">
        <div class="card">
            <div class="card-header" data-background-color="default">
                <h4 class="title">Asosiy ma'lumotlar</h4>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'name') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'faculty_id')->dropDownList(Attend::getFaculty(), ['prompt' => 'Fakultetni tanlang']) ?>
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
                    <div class="col-md-3">
                        <?= $form->field($model, 'born_date')->widget(
                        DatePicker::className(), [
                        'type' => 1,
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd',
                        ]
                        ]);?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'gender_id')->dropDownList(['1' => 'Erkak', '2' => 'Ayol', '3' => 'Aniq emas'], ['prompt' => '']) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'shift_id')->dropDownList(['1' => '1', '2' => '2'], ['prompt' => '']) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'course_id')->dropDownList(['1' => '1', '2' => '2', '3' => '3', '4' => '4',], ['prompt' => '']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="search2" class="col-md-6">
        <div class="card">
            <div class="card-header" data-background-color="default">
                <h4 class="title">Qo'shimcha ma'lumotlar</h4>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'phone_number')->input('number') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'passport_seria')->textInput(['maxlength' => 5]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'passport_number')->input('number') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'faculty_id')->dropDownList(Student::getTypes(), ['prompt' => '']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'adress')->textInput(['maxlength' => 100]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'study_finan')->dropDownList(['1' => 'Grant asosida', '2' => 'To\'lov kontrakt asosida'], ['prompt' => '']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div style="float: right;" class="form-group">
            <?= Html::submitButton('Qidirish', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>




    <?php ActiveForm::end(); ?>

