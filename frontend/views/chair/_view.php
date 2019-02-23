<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<a href="<?php echo Url::to(['chair/view2','id'=>$model->id])?>">
    <div class="alert">
        <span style="float: right;">94%</span>
        <h4><?= $model->name ?></h4>
        
    </div>
</a>
