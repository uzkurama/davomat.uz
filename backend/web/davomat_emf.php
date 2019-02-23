<?

$con = mysqli_connect('localhost','root','','davomat') or die ("Ulanishda xatolik");
$fak= Yii::$app->user->identity->faculty_id;
session_start();
$this->title = Davomat;
?>
<div style="margin-top: 100px;">
<div class="card">
	<div class="card-content">
			<h2>Davomat </h2>
			<h3> <? if (isset($_SESSION['fakn'])&&isset($_SESSION['kafn'])&&isset($_POST['gur'])){
				echo "\"".$_SESSION['fakn']." -> ".$_SESSION['kafn']." -> ".$_SESSION['gurn']."\"";}?>  </h3>
			
			<?php				
				$que = mysqli_query($con,"SELECT * FROM faculty WHERE id =$fak ");
				$que = mysqli_fetch_array($que,MYSQLI_ASSOC);
				$_SESSION['fakn']=$que['name'];	
			?>
			<form class="form-group" name="kform" method="post" action="?kafedra">
			<label class="control-label">Kafedrani tanlang:</label>
			<input type="hidden" value="<?=$_SESSION['fak'];?>" name="fak">
			<select name="kaf" class="form-control" onchange="kform.submit()">
				<option >Select...</option>
				<? 
					$que2 = mysqli_query($con,"SELECT * FROM chair WHERE faculty_id=$fak ") ;
							while($f = mysqli_fetch_array($que2,MYSQLI_ASSOC)){ 
				?>
					<option value="<?=$f['id']?>">
						<?=$f['name']?>
					</option> 
				<?
					}	
				?>
			</select>
			</form>
		<?
		if (isset($_SESSION['fak']) && isset($_POST['kaf'])){
			
			$kaf = $_POST['kaf'];
			$_SESSION['kaf']=$kaf;
			$fak =$_SESSION['fak'];
			
			$que = mysqli_query($con,"SELECT * FROM chair WHERE faculty_id=$kaf ");
				$que = mysqli_fetch_array($que,MYSQLI_ASSOC);
				$_SESSION['kafn']= $que['name'];
			?>
		<form class="form-group" name="gform" method="post" action="?guruh">
			<label class="control-label">Guruhni tanlang:</label>
			<input type="hidden" value="<?=$_SESSION['fak'];?>" name="fak">
			<input type="hidden" value="<?=$_SESSION['kaf'];?>" name="kaf">
			<select class="form-control" name="gur"  onchange="gform.submit()">
			
				<option >Select...</option>
				<? 
				
					$que = mysqli_query($con,"SELECT * FROM `group` WHERE chair_id=$kaf and faculty_id=$fak") ;
					
					
					while($f = mysqli_fetch_array($que,MYSQLI_ASSOC)){ 
					 ?>
					<option value="<?=$f['id']?>">
						<?=$f['name']?>
					</option> 
					<?}	?>
			</select>
			</form>
				<?}
		if (isset($_POST['kaf'])&&isset($_POST['fak'])&&isset($_POST['gur'])){
			$_SESSION['gur']=$_POST['gur'];


			$zap=mysqli_query($con,"SELECT * FROM `group` WHERE id=".$_SESSION['gur']) ;
			$gru=mysqli_fetch_array($zap,MYSQLI_ASSOC) or die($con->error);
			$_SESSION['gurn']=$gru['name'];

			$kaf = $_POST['kaf'];
			$fak = $_POST['fak'];
			$gur = $_POST['gur'];

			?>
		<form class="form-group" name="pform" method="post" action="?para">
			<label class="control-label">Dars juftligini tanlang:</label>
			<input type="hidden" value="<?=$_SESSION['fak'];?>" name="fak">
			<input type="hidden" value="<?=$_SESSION['kaf'];?>" name="kaf">
			<input type="hidden" value="<?=$_SESSION['gur'];?>" name="gur">
			<select class="form-control" name="para"  onchange="pform.submit()">
			
				<option >Select...</option>
				<? 
				
					$que = mysqli_query($con,"SELECT * FROM lesson");
						while($f = mysqli_fetch_array($que,MYSQLI_ASSOC)){ 
					 ?>
					<option value="<?=$f['id']?>">
						<?=$f['name']?>
					</option> 
					<?
					}	
				?>
			</select>
			</form>
		<?
			
		}
		if (isset($_POST['kaf'])&&isset($_POST['fak'])&&isset($_POST['gur'])&&isset($_POST['para'])){
			$kaf = $_POST['kaf'];
			$fak = $_POST['fak'];
			$gur = $_POST['gur'];
			$para = $_POST['para'];
			$_SESSION['para']=$para;
			$st = mysqli_query($con,"SELECT * FROM student WHERE group_id=$gur and faculty_id=$fak and chair_id=$kaf  ORDER BY id ASC");
			$count = mysqli_num_rows($st);
			?>

		<form class="form-group" action="#"  method="post">

		<br>
			<table class="table table-striped table-bordered" border="1px solid">
				<thead>
				<tr>
					<th style="padding: 5px;">№</th>
					<th style="padding: 5px;">Talaba</th>
					<th style="padding: 5px;">Guruh</th>
					<th style="padding: 5px;">Fakultet</th>
					<th style="padding: 5px;">Sababli/Sababsiz</th>
					<th style="padding: 5px;"><?=$para?>-para</th>
					
				</tr>
				</thead>
				<? $j=1;
				while ($student = mysqli_fetch_array($st, MYSQLI_ASSOC)){
				$fac_id = $student['faculty_id'];
				$gr_id = $student['group_id'];
				$st1 = mysqli_query($con,"SELECT * FROM faculty WHERE id = $fac_id");
				$faculty = mysqli_fetch_array($st1);
				$st2 = mysqli_query($con,"SELECT * FROM `group` WHERE id= $gr_id ");
				$group = mysqli_fetch_array($st2) ;

				?>
				<tbody>
				<tr>
					<td style="padding: 5px;"><?=$j?><input type="hidden" name="st_id<?=$j?>" value="<?=$student['id']?>"></td>
					<td style="padding: 5px;"><?=$student['name']?><input type="hidden" name="st_name<?=$j?>" value="<?=$student['name']?>"></td>
					<td style="padding: 5px;"><?=$group['name']?><input type="hidden" name="st_gr<?=$j?>" value="<?=$student['group_id']?>"></td>
					<td style="padding: 5px;"><?=$faculty['name']?><input type="hidden" name="st_fac<?=$j?>" value="<?=$student['faculty_id']?>"></td>
					<td style="padding: 5px;"><div class="checkbox"><label><input type="checkbox" name="a<?=$j?>" ></label></div></td>
					<td style="padding: 5px;"><div class="checkbox"><label><input type="checkbox" name="p<?=$j?>" ></label></div></td>
					<input type="hidden" name="st_chair<?=$j?>" value="<?=$student['chair_id']?>">
					<input type="hidden" name="st_shift<?=$j?>" value="<?=$group['shift_id']?>">
					<input type="hidden" name="st_course<?=$j?>" value="<?=$group['course_id']?>">
					<input type="hidden" name="date" value="<?=date('Y-m-d')?>">
				</tr>
				</tbody>
				<? $j++; }
				?>
			</table>
			<button class="btn btn-success" name="save" >Saqlash</button>
		</form>
		</div>
	</div>
</div>

<?
}



$st = mysqli_query($con,"SELECT * FROM student ORDER BY id ASC");
$count = mysqli_num_rows($st);

?>


<?

if (isset($_POST['save'])) {
	
		$p = $_SESSION['para'];
	for ($i=1; $i<=$count; $i++ ){

		$st_id = $_POST['st_id'.$i];
		$date = $_POST['date'];
		$st_gr = $_POST['st_gr'.$i];
		$st_fac = $_POST['st_fac'.$i];
		$st_chair = $_POST['st_chair'.$i];
		$st_shift = $_POST['st_shift'.$i];
		$st_course = $_POST['st_course'.$i];
		
		if (isset($_POST['p'.$i]) && $_POST['p'.$i]=="on" )	 {
			if (isset($_POST['a'.$i]) && $_POST['a'.$i]=="on"){
				$query = mysqli_query($con,"INSERT INTO attend(attend,lesson_id,student_id,group_id,chair_id,faculty_id,shift_id,course_id,sababli,date) 
				VALUES (1,$p,$st_id,$st_gr,$st_chair,$st_fac,$st_shift,$st_course,1,'$date') ");
			}
			else if (!isset($_POST['a'.$i]) && $_POST['a'.$i]!="on"){
				$query = mysqli_query($con,"INSERT INTO attend(attend,lesson_id,student_id,group_id,chair_id,faculty_id,shift_id,course_id,sababli,date) 
				VALUES (1,$p,$st_id,$st_gr,$st_chair,$st_fac,$st_shift,$st_course,0,'$date') ");
			}
		}
		else{
			$query = mysqli_query($con,"INSERT INTO attend(attend,lesson_id,student_id,group_id,chair_id,faculty_id,shift_id,course_id,sababli,date) 
			VALUES (0,$p,$st_id,$st_gr,$st_chair,$st_fac,$st_shift,$st_course,0,'$date') ");
		}
		
		
	
}
}
?>

