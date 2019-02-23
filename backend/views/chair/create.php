<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Chair */

$this->title = 'Yo\'nalish (kafedra) kiritish';
$this->params['breadcrumbs'][] = ['label' => 'Chairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
