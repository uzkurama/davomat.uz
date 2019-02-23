<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\Group;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;


/* @var $this yii\web\View */
/* @var $model common\models\Group */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'faculty_id')->dropDownlist(Group::getFaculty(), ['prompt'=> 'Fakultetni tanlang', 'id' => 'cat-id'])  ?>

	<?= $form->field($model, 'chair_id')->widget(DepDrop::classname(), [
	    'options'=>['id'=>'subcat-id', 'prompt'=> 'Kafedrani tanlang'],
	    'pluginOptions'=>[
	        'depends'=>['cat-id'],
	        'placeholder'=>'Select...',
	        'url'=>Url::to(['group/subcat'])
	    ]
	]);
	?>

	<?= $form->field($model, 'shift_id')->dropDownList(['1' => '1-smena', '2' => '2-smena'],['prompt'=>'Smena tanlang']);?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
