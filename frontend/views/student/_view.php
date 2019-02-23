<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="col-md-6">
    <div class="card">
        <div class="col-md-2">
        	<?php if($model->image != null) {?>
            <img style="margin-top: 10px; width: 85px;" src="<?= Yii::$app->request->baseUrl; ?>/admin/<?= $model->image; ?>">
            <?php } else {?>
            <img style="margin-top: 10px;" src="<?= Yii::$app->request->baseUrl; ?>/img/no_photo.png">
            <?php }?>
        </div>
        <div class="col-md-9">
		    <div class="card-content">
		    	<a href="<?= Url::to(['attend/view','id'=>$model->id]) ?>"><?= $model->name;?></a>
		        <p class="category"><?= $model->getAttributeLabel(gender_id);?>: <?php switch ($model->gender_id) {
                            case '1':
                                echo "Erkak";
                                break;
                            case '2':
                                echo "Ayol";
                                break;
                            case '3':
                                echo "Aniq emas";
                                break;
                            
                            default:
                                echo "Kiritilmagan";
                                break;
                        } ?></p>
		        <p class="category"><?= $model->getAttributeLabel(faculty_id);?>: <?= $model->faculties->name;?></p>
		        <p class="category"><?= $model->getAttributeLabel(chair_id);?>: <?= $model->chairs->name;?></p>
		        <p class="category"><?= $model->getAttributeLabel(group_id);?>: <?= $model->group_details->name;?></p>
		    </div>
            <div class="card-footer">
            	<p><?= $model->getAttributeLabel(study_finan);?>: <?php if($model->study_finan = 1){echo "Grant asosida";} else if($model->study_finan = 2){echo "To'lov kontrakt asosida";}  ?></p>
        	</div>
        </div>

    </div>
</div>