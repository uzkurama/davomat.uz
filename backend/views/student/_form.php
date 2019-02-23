<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Student;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-md-3">
					    	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
						</div>

						<div class="col-md-3">
					    	<?= $form->field($model, 'faculty_id')->dropDownList(Student::getFaculty(), ['prompt' => 'Fakultetni tanlang', 'id' => 'cat-id']) ?>
					    </div>

					    <div class="col-md-3">
						    <?= $form->field($model, 'chair_id')->widget(DepDrop::classname(), [
							    'options'=>['id'=>'subcat-id', 'prompt' => 'Kafedrani tanlang'],
							    'pluginOptions'=>[
							        'depends'=>['cat-id'],
							        'placeholder' => 'Kafedrani tanlang',
							        'url'=>Url::to(['/student/chaircat'])
							    ]
							]); ?>
						</div>

						<div class="col-md-3">
						    <?= $form->field($model, 'group_id')->widget(DepDrop::classname(), [
							    'pluginOptions'=>[
							        'depends'=>['cat-id', 'subcat-id'],
							        'placeholder'=>'Guruhni tanlang',
							        'url'=>Url::to(['/student/groupcat'])
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
						            'format' => 'yyyy-mm-dd'
						        ]
						    ]);?>
					    </div>

					    <div class="col-md-3">
							<?= $form->field($model, 'passport_seria')->textInput(['maxlength' => 5]) ?>
						</div>

						<div class="col-md-3">
							<?= $form->field($model, 'passport_number')->input('number', ['maxlength' => 15]) ?>
						</div>

						<div class="col-md-3">
							<?= $form->field($model, 'gender_id')->dropDownList(['1' => 'Erkak', '2' => 'Ayol', '3' => 'Aniq emas'], ['prompt' => '']) ?>
						</div>
					</div>

					<div class="row">
						<div class="col-md-2">
							<?= $form->field($model, 'study_finan')->dropDownList([1 => 'Grant asosida', 2 => 'To\'lov kontrakt asosida'],['prompt'=>'']);?>
						</div>

						<div class="col-md-2">
							<?= $form->field($model, 'type_home')->dropDownList(Student::getTypes(),['prompt'=>'']);?>
						</div>

						<div class="col-md-3">
							<?= $form->field($model, 'adress')->textInput(['maxlength' => 100]) ?>
						</div>
						<div class="col-md-5">
							<?= $form->field($model, 'phone_number')->input('number', ['maxlength' => 12]) ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<?= $form->field($model, 'father_name')->textInput(['maxlength' => 200]) ?>
						</div>

						<div class="col-md-6">
							<?= $form->field($model, 'mother_name')->textInput(['maxlength' => 200]) ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<?= $form->field($model, 'father_number')->input('number', ['maxlength' => 12]) ?>
						</div>

						<div class="col-md-6">
							<?= $form->field($model, 'mother_number')->input('number', ['maxlength' => 12]) ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<?= $form->field($model, 'father_post')->textInput(['maxlength' => 200]) ?>
						</div>

						<div class="col-md-6">
							<?= $form->field($model, 'mother_post')->textInput(['maxlength' => 200]) ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-md-12">
							<center>
								<?= $form->field($model, 'imgFile', ['options' => ['class' => '']])->fileInput(['class' => '']);?>
								<?php $this->registerJs("function readURL(input) {
	                                                  if (input.files && input.files[0]) {
	                                                    var reader = new FileReader();

	                                                    reader.onload = function(e) {
	                                                      $('#student-imgfile-preview').attr('src', e.target.result);
	                                                    }

	                                                    reader.readAsDataURL(input.files[0]);
	                                                  }
	                                                }

	                                                $('#student-imgfile').change(function() {
	                                                  readURL(this);
	                                                });");?>
	                            <img style="width: 50%; margin-top: 5px;" id="student-imgfile-preview" src="#" alt="" />
                            </center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>