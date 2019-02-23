<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Chair */

$this->title = $model->name."ni"." "."yangilash";
$this->params['breadcrumbs'][] = ['label' => 'Chairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="card">
        <div class="card-content">

		    <h2><?= Html::encode($this->title) ?></h2>

		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>

        </div>
    </div>
</div>
