<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'NDKI davomati sistemasiga kirish';
?>
<div class="container">
    <div align="center" style="float: none; display: table; margin: 0 auto; vertical-align: middle; " class="col-md-5">
        <div class="card">
            <div class="card-content">
                <h3><?= Html::encode($this->title) ?></h3>
                        <?php if( Yii::$app->session->hasFlash('error') ): ?>
                         <div class="alert alert-danger">
                            <span><?php echo Yii::$app->session->getFlash('error'); ?></span>
                         </div>
                        <?php endif;?>
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'password')->passwordInput() ?>
                                </div>
                            </div>
                            <div style="float: right;" class="form-group">
                                <?= Html::submitButton('Kirish', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
