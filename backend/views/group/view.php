<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Group */

$this->title = $model->name." guruhi";
$this->params['breadcrumbs'][] = ['label' => 'Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="card">
        <div class="card-content">

            <h2><?= Html::encode($this->title) ?></h2>

            <p>
                <?= Html::a('Guruhni yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Guruhni o\'chirish', ['delete', 'id' => $model->id], [
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
                        'value' => $model->faculties->name,
                    ],
                    [
                        'label' => 'Yo\'nalishi',
                        'value' => $model->chairs->name,
                    ],
                    'shift_id',
                ],
            ]) ?>

        </div>
    </div>
</div>
