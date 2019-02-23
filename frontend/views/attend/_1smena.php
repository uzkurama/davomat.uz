<?php 

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Attend;
use frontend\controllers\AttendController;
use common\models\Group;
use common\models\Student;

		$fac_stud_count = Student::find()->where(['faculty_id' => $model->id])->count();
		$smena = 1;
		$chair = '';
?>

	<tbody style="text-align: center;">
		
		<tr>
			<td rowspan="4"><a href="<?php echo Url::to(['a/c','id'=>$model->id,'s'=>$smena]) ?>"><?= $model->name;?></a></td>
			<?php for ($i=1; $i <= 4; $i++) {?>
			<td><?= $i;?></td>
			<td><?php if(Yii::$app->runAction('attend/studentcount', ['chair' => $chair, 'fac' => $model->id, 'cour' => $i, 'smena' => $smena]) != 0) { echo Yii::$app->runAction('attend/studentcount', ['chair' => $chair, 'fac' =>  $model->id, 'cour' => $i, 'smena' => $smena]);} else { echo "";}?></td>
			<?php for ($j=1; $j <= 4; $j++) {?>
			<td><?php if(Yii::$app->runAction('attend/para', ['chair' => $chair, 'fac' => $model->id, 'cour' => $i, 'smena' => $smena, 'lesson_id' => $j]) != 0) { echo Yii::$app->runAction('attend/para', ['chair' => $chair, 'fac' =>  $model->id, 'cour' => $i, 'smena' => $smena, 'lesson_id' => $j]);} else { echo "";}?></td>
			<td id="per_id1_<?= $i?>_<?= $j;?>_<?= $model->id?>"><?php if(Yii::$app->runAction('attend/para_foiz', ['chair' => $chair, 'fac' => $model->id, 'cour' => $i, 'smena' => $smena, 'lesson_id' => $j]) != 0) { echo round(Yii::$app->runAction('attend/para_foiz', ['chair' => $chair, 'fac' =>  $model->id, 'cour' => $i, 'smena' => $smena, 'lesson_id' => $j]), 2)."%";} else { echo "";}?></td>
			<?php }?>
			<td id="jami_all1_<?= $i;?>_<?= $model->id;?>"></td>
		</tr>
		<?php }?>
		<tr> 
			<td colspan="2">Jami <?= $model->name?></td>
			<td><?php if(Yii::$app->runAction('attend/studentcount', ['chair' => $chair, 'fac' => $model->id, 'cour' => '', 'smena' => $smena]) != 0) { echo Yii::$app->runAction('attend/studentcount', ['chair' => $chair, 'fac' =>  $model->id, 'cour' => '', 'smena' => $smena]);} else { echo "";}?></td>
			<?php for ($j=1; $j <= 4; $j++) {?>
			<td><?php if(Yii::$app->runAction('attend/para', ['chair' => $chair, 'fac' => $model->id, 'cour' => '', 'smena' => $smena, 'lesson_id' => $j]) != 0) { echo Yii::$app->runAction('attend/para', ['chair' => $chair, 'fac' =>  $model->id, 'cour' => '', 'smena' => $smena, 'lesson_id' => $j]);} else { echo "";}?></td>
			<td id="id1_<?= $j?>_<?= $model->id;?>"><?php if(Yii::$app->runAction('attend/para_foiz', ['chair' => $chair, 'fac' => $model->id, 'cour' => '', 'smena' => $smena, 'lesson_id' => $j]) != 0) { echo round(Yii::$app->runAction('attend/para_foiz', ['chair' => $chair, 'fac' =>  $model->id, 'cour' => '', 'smena' => $smena, 'lesson_id' => $j]), 2)."%";} else { echo "";}?></td>
			<?php }?>
			<td id="jami_fac_1_<?= $model->id;?>"></td>
			<script type="text/javascript">
				<?php for ($y=1; $y <= 4; $y++) {?>
					var jami<?= $y;?>_<?= $model->id?> = document.getElementById ("id1_<?= $y;?>_<?= $model->id?>").textContent;
				<?php }?>

				<?php for ($v=1; $v <= 4; $v++) {?>
					jami<?= $v;?>_<?= $model->id?> = jami<?= $v;?>_<?= $model->id?>.slice(0, -1);
				<?php }?>

				<?php for ($s=1; $s <= 4; $s++) {?>
					jami<?= $s;?>_<?= $model->id?> = [Number(jami<?= $s;?>_<?= $model->id?>)];
				<?php }?>


				var all_<?= $model->id;?> = [];

				<?php for ($i=1; $i <= 4; $i++) {?>
					if(jami<?= $i;?>_<?= $model->id?> > 0)
					{
						all_<?= $model->id;?>.push(jami<?= $i;?>_<?= $model->id?>);
					}
				<?php }?>

				var sum_<?= $model->id;?> = 0;
				for (var i = 0; i < all_<?= $model->id;?>.length; i++) {
				  sum_<?= $model->id;?> += parseFloat(all_<?= $model->id;?>[i]);
				}
				var res_<?= $model->id;?> = sum_<?= $model->id;?>/all_<?= $model->id;?>.length; 

				document.getElementById("jami_fac_1_<?= $model->id;?>").innerHTML = res_<?= $model->id;?>.toFixed(2) + "%";
			</script>
			
			<script type="text/javascript">
			<?php for ($a=1; $a <= 4; $a++) {?>
			<?php for ($b=1; $b <= 4; $b++) {?>
				var per_id<?= $a;?>_<?= $b;?>_<?= $model->id?> = document.getElementById("per_id1_<?= $a;?>_<?= $b;?>_<?= $model->id;?>").textContent;

			<?php }?>
			<?php }?>

			<?php for ($c=1; $c <= 4; $c++) {?>
			<?php for ($d=1; $d <= 4; $d++) {?>
				per_id<?= $c;?>_<?= $d;?>_<?= $model->id;?> = per_id<?= $c;?>_<?= $d;?>_<?= $model->id;?>.slice(0, -1);
			<?php }?>
			<?php }?>

			<?php for ($e=1; $e <= 4; $e++) {?>
			<?php for ($f=1; $f <= 4; $f++) {?>			
				per_id<?= $e;?>_<?= $f;?>_<?= $model->id;?> = [Number(per_id<?= $e;?>_<?= $f;?>_<?= $model->id;?>)];

			<?php }?>
			<?php }?>

			<?php for ($g=1; $g <= 4; $g++) {?>
				var all<?= $g;?>_<?= $model->id;?> = [];
			<?php }?>

			<?php for ($k=1; $k <= 4; $k++) {?>
			<?php for ($m=1; $m <= 4; $m++) {?>
			if(per_id<?= $k;?>_<?= $m;?>_<?= $model->id;?> > 0)
				{
					all<?= $k;?>_<?= $model->id;?>.push(per_id<?= $k;?>_<?= $m;?>_<?= $model->id;?>);
				}
			<?php }?>
			<?php }?>

			<?php for ($n=1; $n <= 4; $n++) {?>
				var sum<?= $n;?>_<?= $model->id;?> = 0;
			<?php }?>

			<?php for ($q=1; $q <= 4; $q++) {?>
				for (var i = 0; i < all<?= $q;?>_<?= $model->id;?>.length; i++) {
				  sum<?= $q;?>_<?= $model->id;?> += parseFloat(all<?= $q;?>_<?= $model->id;?>[i]);
				}
			<?php }?>

			<?php for ($p=1; $p <= 4; $p++) {?>
				var res<?= $p;?>_<?= $model->id;?> = sum<?= $p;?>_<?= $model->id;?>/all<?= $p;?>_<?= $model->id;?>.length; 
			<?php }?>

			<?php for ($r=1; $r <= 4; $r++) {?>
				document.getElementById("jami_all1_<?= $r;?>_<?= $model->id;?>").innerHTML = res<?= $r;?>_<?= $model->id;?>.toFixed(2) + "%";
			<?php }?>

			</script>
				

			
		</tr>
	</tbody>



