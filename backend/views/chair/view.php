<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Chair */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Chairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="card">
        <div class="card-content">

            <h2><?= Html::encode($this->title) ?></h2>

            <p>
                <?= Html::a('Yo\'nalishni yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Yo\'nalishni o\'chirish', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Siz rostdan ham ushbu elementni o`chirmoqchimisiz?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    [
                        'label' => 'Fakulteti',
                        'value' => $model->faculty->name
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>
