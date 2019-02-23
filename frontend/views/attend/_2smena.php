<?php 

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Attend;
use frontend\controllers\AttendController;
use common\models\Group;
use common\models\Student;

		$fac_stud_count = Student::find()->where(['faculty_id' => $model->id])->count();
		$smena = 2;
		$chair = '';
?>

	<tbody style="text-align: center;">
		
		<tr>
			<td rowspan="4"><a href="<?php echo Url::to(['a/c','id'=>$model->id, 's'=>$smena]) ?>"><?= $model->name;?></a></td>
			<?php for ($i=1; $i <= 4; $i++) {?>
			<td><?= $i;?></td>
			<td><?php if(Yii::$app->runAction('attend/studentcount', ['chair' => $chair, 'fac' => $model->id, 'cour' => $i, 'smena' => $smena]) != 0) { echo Yii::$app->runAction('attend/studentcount', ['chair' => $chair, 'fac' =>  $model->id, 'cour' => $i, 'smena' => $smena]);} else { echo "";}?></td>
			<?php for ($j=1; $j <= 4; $j++) {?>
			<td><?php if(Yii::$app->runAction('attend/para', ['chair' => $chair, 'fac' => $model->id, 'cour' => $i, 'smena' => $smena, 'lesson_id' => $j]) != 0) { echo Yii::$app->runAction('attend/para', ['chair' => $chair, 'fac' =>  $model->id, 'cour' => $i, 'smena' => $smena, 'lesson_id' => $j]);} else { echo "";}?></td>
			<td id="per_id2_<?= $i?>_<?= $j;?>_<?= $model->id?>"><?php if(Yii::$app->runAction('attend/para_foiz', ['chair' => $chair, 'fac' => $model->id, 'cour' => $i, 'smena' => $smena, 'lesson_id' => $j]) != 0) { echo round(Yii::$app->runAction('attend/para_foiz', ['chair' => $chair, 'fac' =>  $model->id, 'cour' => $i, 'smena' => $smena, 'lesson_id' => $j]), 2)."%";} else { echo "";}?></td>
			<?php }?>
			<td id="jami_all2_<?= $i;?>_<?= $model->id;?>"></td>
		</tr>
		<?php }?>
		<tr> 
			<td colspan="2">Jami <?= $model->name?></td>
			<td><?php if(Yii::$app->runAction('attend/studentcount', ['chair' => $chair, 'fac' => $model->id, 'cour' => "", 'smena' => $smena]) != 0) { echo Yii::$app->runAction('attend/studentcount', ['chair' => $chair, 'fac' =>  $model->id, 'cour' => "", 'smena' => $smena]);} else { echo "";}?></td>
			<?php for ($j=1; $j <= 4; $j++) {?>
			<td><?php if(Yii::$app->runAction('attend/para', ['chair' => $chair, 'fac' => $model->id, 'cour' => "", 'smena' => $smena, 'lesson_id' => $j]) != 0) { echo Yii::$app->runAction('attend/para', ['chair' => $chair, 'fac' =>  $model->id, 'cour' => "", 'smena' => $smena, 'lesson_id' => $j]);} else { echo "";}?></td>
			<td id="id2_<?= $j?>_<?= $model->id;?>"><?php if(Yii::$app->runAction('attend/para_foiz', ['chair' => $chair, 'fac' => $model->id, 'cour' => "", 'smena' => $smena, 'lesson_id' => $j]) != 0) { echo round(Yii::$app->runAction('attend/para_foiz', ['chair' => $chair, 'fac' =>  $model->id, 'cour' => "", 'smena' => $smena, 'lesson_id' => $j]), 2)."%";} else { echo "";}?></td>
			<?php }?>
			<td id="jami_fac_2_<?= $model->id;?>"></td>
			<script type="text/javascript">
				<?php for ($y2=1; $y2 <= 4; $y2++) {?>
					var jami<?= $y2;?>_<?= $model->id?> = document.getElementById ("id2_<?= $y2;?>_<?= $model->id?>").textContent;
				<?php }?>

				<?php for ($v2=1; $v2 <= 4; $v2++) {?>
					jami<?= $v2;?>_<?= $model->id?> = jami<?= $v2;?>_<?= $model->id?>.slice(0, -1);
				<?php }?>

				<?php for ($s2=1; $s2 <= 4; $s2++) {?>
					jami<?= $s2;?>_<?= $model->id?> = [Number(jami<?= $s2;?>_<?= $model->id?>)];
				<?php }?>


				var all_<?= $model->id;?> = [];

				<?php for ($i2=1; $i2 <= 4; $i2++) {?>
					if(jami<?= $i2;?>_<?= $model->id?> > 0)
					{
						all_<?= $model->id;?>.push(jami<?= $i2;?>_<?= $model->id?>);
					}
				<?php }?>

				var sum_<?= $model->id;?> = 0;
				for (var i = 0; i < all_<?= $model->id;?>.length; i++) {
				  sum_<?= $model->id;?> +=  parseFloat(all_<?= $model->id;?>[i]);
				}
				console.log(sum_1);
				var res_<?= $model->id;?> = sum_<?= $model->id;?>/all_<?= $model->id;?>.length; 

				document.getElementById("jami_fac_2_<?= $model->id;?>").innerHTML = res_<?= $model->id;?>.toFixed(2) + "%";
			</script>
			
			<script type="text/javascript">
			<?php for ($a2=1; $a2 <= 4; $a2++) {?>
			<?php for ($b2=1; $b2 <= 4; $b2++) {?>
				var per_id<?= $a2;?>_<?= $b2;?>_<?= $model->id?> = document.getElementById("per_id2_<?= $a2;?>_<?= $b2;?>_<?= $model->id;?>").textContent;

			<?php }?>
			<?php }?>

			<?php for ($c2=1; $c2 <= 4; $c2++) {?>
			<?php for ($d2=1; $d2 <= 4; $d2++) {?>
				per_id<?= $c2;?>_<?= $d2;?>_<?= $model->id;?> = per_id<?= $c2;?>_<?= $d2;?>_<?= $model->id;?>.slice(0, -1);
			<?php }?>
			<?php }?>

			<?php for ($e2=1; $e2 <= 4; $e2++) {?>
			<?php for ($f2=1; $f2 <= 4; $f2++) {?>			
				per_id<?= $e2;?>_<?= $f2;?>_<?= $model->id;?> = [Number(per_id<?= $e2;?>_<?= $f2;?>_<?= $model->id;?>)];

			<?php }?>
			<?php }?>

			<?php for ($g2=1; $g2 <= 4; $g2++) {?>
				var all<?= $g2;?>_<?= $model->id;?> = [];
			<?php }?>

			<?php for ($k2=1; $k2 <= 4; $k2++) {?>
			<?php for ($m2=1; $m2 <= 4; $m2++) {?>
			if(per_id<?= $k2;?>_<?= $m2;?>_<?= $model->id;?> > 0)
				{
					all<?= $k2;?>_<?= $model->id;?>.push(per_id<?= $k2;?>_<?= $m2;?>_<?= $model->id;?>);
				}
			<?php }?>
			<?php }?>

			<?php for ($n2=1; $n2 <= 4; $n2++) {?>
				var sum<?= $n2;?>_<?= $model->id;?> = 0;
			<?php }?>

			<?php for ($q2=1; $q2 <= 4; $q2++) {?>
				for (var i = 0; i < all<?= $q2;?>_<?= $model->id;?>.length; i++) {
				  sum<?= $q2;?>_<?= $model->id;?> +=  parseFloat(all<?= $q2;?>_<?= $model->id;?>[i]);
				}
			<?php }?>

			<?php for ($p2=1; $p2 <= 4; $p2++) {?>
				var res<?= $p2;?>_<?= $model->id;?> = sum<?= $p2;?>_<?= $model->id;?>/all<?= $p2;?>_<?= $model->id;?>.length; 
			<?php }?>

			<?php for ($r2=1; $r2 <= 4; $r2++) {?>
				document.getElementById("jami_all2_<?= $r2;?>_<?= $model->id;?>").innerHTML = res<?= $r2;?>_<?= $model->id;?>.toFixed(2) + "%";
			<?php }?>

			</script>
				

			
		</tr>
	</tbody>



