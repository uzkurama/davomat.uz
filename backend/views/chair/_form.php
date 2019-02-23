<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Faculty;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Chair */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chair-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'faculty_id')->dropDownlist(ArrayHelper::map(Faculty::find()->all(),'id','name'),['prompt'=> Yii::t('app', 'Fakultetni tanlang')]) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>