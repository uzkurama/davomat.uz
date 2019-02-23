<?php 

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Attend;
use frontend\controllers\AttendController;
use common\models\Group;
use common\models\Student;

$params = Yii::$app->request->queryParams;
?>



    <tbody style="text-align: center;">
        <tr>
            <td><a href="<?php echo Url::to(['a/v','id'=>$model->id]) ?>"><center><img style="width: 80px;" src="<?= Yii::$app->request->baseUrl;?>/admin/<?= $model->image;?>"><br><?= $model->name;?></center></a></td>
            <?php for ($i=1; $i <= 4; $i++) {?>
            <td id="id<?= $i?>"><?php if(Yii::$app->runAction('attend/talaba_attend', ['group' => $model->group_id, 'student' => $model->id, 'lesson_id' => $i]) != null) { echo Yii::$app->runAction('attend/talaba_attend', ['group' => $model->group_id, 'student' => $model->id, 'lesson_id' => $i]);} else { echo "";}?></td>
            <td id="id<?= $i?>"><?php if(Yii::$app->runAction('attend/talaba_cause', ['group' => $model->group_id, 'student' => $model->id, 'lesson_id' => $i]) != null) { echo Yii::$app->runAction('attend/talaba_cause', ['group' => $model->group_id, 'student' => $model->id, 'lesson_id' => $i]);} else { echo "";}?></td>
            <?php }?>
        </tr>
    </tbody>



