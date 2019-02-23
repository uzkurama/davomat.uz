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
            <td rowspan="4"><a href="<?php echo Url::to(['a/s','id'=>$model->id,'s'=>$params[s]]) ?>"><?= $model->name;?><br>Jami talabalar soni: <?= Yii::$app->runAction('attend/group_sum', ['chair' => $params[id], 'group' => $model->id]);?><br>Jami guruh sababli qoldirgan soati: <?= Yii::$app->runAction('attend/group_all_attend_cause', ['chair' => $params[id], 'group' => $model->id]);?><br>Jami guruh sababsiz qoldirgan soati: <?= Yii::$app->runAction('attend/group_all_attend_uncause', ['chair' => $params[id], 'group' => $model->id]);?></a></td>
            <?php for ($i=1; $i <= 4; $i++) {?>
            <td><?= $i;?></td>
            <td><?php if(Yii::$app->runAction('attend/group_davomat', ['chair' => $params[id], 'group' => $model->id, 'lesson_id' => $i]) != 0) { echo Yii::$app->runAction('attend/group_davomat', ['chair' => $params[id], 'group' => $model->id, 'lesson_id' => $i]);} else { echo "";}?></td>
            <td><?php if(Yii::$app->runAction('attend/group_davomat_foiz', ['chair' => $params[id], 'group' => $model->id, 'lesson_id' => $i]) != 0) { echo round(Yii::$app->runAction('attend/group_davomat_foiz', ['chair' => $params[id], 'group' => $model->id, 'lesson_id' => $i]), 2)."%";} else { echo "";}?></td>
            <td><?php if(Yii::$app->runAction('attend/group_davomat_cause', ['cause' => 0, 'chair' => $params[id], 'group' => $model->id, 'lesson_id' => $i]) != 0) { echo Yii::$app->runAction('attend/group_davomat_cause', ['cause' => 0, 'chair' => $params[id], 'group' => $model->id, 'lesson_id' => $i]);} else { echo "";}?></td>
            <td><?php if(Yii::$app->runAction('attend/group_davomat_cause', ['cause' => 1, 'chair' => $params[id], 'group' => $model->id, 'lesson_id' => $i]) != 0) { echo Yii::$app->runAction('attend/group_davomat_cause', ['cause' => 1, 'chair' => $params[id], 'group' => $model->id, 'lesson_id' => $i]);} else { echo "";}?></td>
        </tr>
        <?php }?>

    </tbody>




