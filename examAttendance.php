

<h1>Exam Attendance</h1>
<?php
//2021.03.24 start  include('dbAccess.php');
require_once("dbAccess.php");
$db = new DBOperations();

$faculty = null;
$semester = null;
$level = null;
$SubjectID = null;
$acyear = null;
//====================================
if (isset($_POST['lstFaculty'])) {
	//$faculty=$_POST['lstFaculty'];
	$faculty = $db->cleanInput($_POST['lstFaculty']);
}

if (isset($_POST['subSemester'])) {
	$semester = $db->cleanInput($_POST['subSemester']);
	//$semester=$_POST['subSemester'];
}
if (isset($_POST['level'])) {
	$level = $db->cleanInput($_POST['level']);
	//$level=$_POST['level'];
}
if (isset($_POST['lstSubject'])) {
	$SubjectID = $db->cleanInput($_POST['lstSubject']);
	//$SubjectID=$_POST['lstSubject'];
}
if (isset($_POST['acyear'])) {
	$acyear = $db->cleanInput($_POST['acyear']);
	//$acyear=$_POST['acyear'];
}
//addendance insert data.
if (isset($_POST['number'])) {
	$rowNum = $_POST['chk'];
	$Count = count($rowNum);
	if ($Count > 0) {
		foreach ($rowNum as $a) {
			$row = explode(";", $a);
			$queryK = "SELECT*FROM studentenrolment WHERE indexNo='$row[1]' AND subjectID='$row[3]' AND acYear ='$row[2]'";
			$resultK = $db->executeQuery($queryK);
			while ($data = $db->Next_Record($resultK)) {
				$dbquary = "SELECT index_no FROM exam_stu_attendance WHERE index_no = '$row[1]' AND subject = $row[3]";
				 $exe = $db->executeQuery($dbquary);
				 $dup = mysqli_num_rows($exe);
				if ($dup == 0 ) {
					$queryS = "INSERT INTO exam_stu_attendance( index_no, subject, ac_year, attendance) 
						VALUES ('$row[1]', '$row[3]', '$row[2]', '$row[0]')";
					$queryS = $db->executeQuery($queryS);
				} else {
					$queryS = "UPDATE exam_stu_attendance set attendance = '$row[0]' WHERE index_no='$row[1]' AND subject = '$row[3]'";
					$db->executeQuery($queryS);
				}
			}
		}
	}
	echo "<script language=\"JavaScript\">\n";
	echo "alert('Attendance Insert Sucsessfull');\n";
	echo "</script>";
}
?>
<form method="post" name="form1" id="form1" action="" onsubmit="return validate_form(this);" class="plain">
	<table class="searchResults">
		<tr>
			<td height="28">Faculty : </td>
			<!-- <td><select name="lstFaculty" id="lstFaculty" onchange="document.form1.submit()"> -->
			<td><select name="lstFaculty" id="lstFaculty" onchange="form1.submit()">
					<option value="Buddhist">Buddhist Studies</option>
					<option value="Language">Language Studies</option>
				</select>
				<script>
					document.getElementById('lstFaculty').value = "<?php echo $faculty; ?>";
				</script>
			</td>
		</tr>
		<tr>
			<td>Level : </td>
			<!-- <td><select name="level" id="level" onchange="document.form1.submit()">  -->
			<td><select name="level" id="level" onchange="form1.submit()">
					<option value="I">Level One</option>
					<option value="II">Level Two</option>
					<option value="III">Level Three</option>
					<option value="IV">Level Four</option>
				</select>
				<script>
					document.getElementById('level').value = "<?php echo $level; ?>";
				</script>
			</td>
		</tr>
		<tr>
			<td>Semester : </td>
			<!-- <td><select name="subSemester" id="subSemester" onchange="document.form1.submit()"> -->
			<td><select name="subSemester" id="subSemester" onchange="form1.submit()">
					<option value="First Semester">First Semester</option>
					<option value="Second Semester">Second Semester</option>
				</select>
				<script>
					document.getElementById('subSemester').value = "<?php echo $semester; ?>";
				</script>
			</td>
		</tr>
		<tr>
			<td>Subject : </td>
			<!-- <td><select name="lstSubject" id="lstSubject" style="width:auto" onchange="document.form1.submit()"> -->
			<td><select name="lstSubject" id="lstSubject" style="width:auto" onchange="form1.submit()">>
					<?php
					$query = "SELECT * FROM subject WHERE faculty='$faculty' and level='$level' and semester='$semester'";
					// print $query;
					//2021-03-25 start  $result = executeQuery($query);
					$result = $db->executeQuery($query);
					//2021.03.25 end
					//2021-03-25 start  for ($i=0;$i<mysql_num_rows($result);$i++)
					// for ($i=0;$i<$db->Row_Count($result);$i++)
					while ($data = $db->Next_Record($result))
					//2021.03.25 end
					{
						$rID = $data["subjectID"];
						$rCode = $data["codeEnglish"];
						$rSubject = $data["nameEnglish"];
						echo "<option value=\"" . $rID . "\">" . $rCode . " - " . $rSubject . "</option>";
					}
					?>
				</select>
				<script>
					document.getElementById('lstSubject').value = '<?php echo $SubjectID; ?>';
				</script>
			</td>
		</tr>
		<tr>
			<td>Academic Year:</td>
			<td><label>
					<?php
					// echo '<select name="acyear" id="acyear"  onChange="document.form1.submit()" class="form-control">'; // Open your drop down box
					echo '<select name="acyear" id="acyear" onChange="form1.submit()"  class="form-control">'; // Open your drop down box
					$sql = "SELECT distinct acYear FROM studentenrolment";
					//2021-03-25 start  $result = executeQuery($sql);
					//echo '<option value="all">Select All</option>';
					$result = $db->executeQuery($sql);
					//echo '<option value="all">Select All</option>';
					while ($row = $db->Next_Record($result)) {
						//2021-03-25 start  while ($row = mysql_fetch_array($result)){
						echo '<option value="' . $row['acYear'] . '">' . $row['acYear'] . '</option>';
					}
					echo '</select>'; // Close drop down box
					?>
					<script>
						document.getElementById('acyear').value = "<?php echo $acyear; ?>";
					</script>
				</label>
			</td>
		</tr>
	</table>
	<br>
	<table border="1px solid black">
		<tr>
			<th rowspan="1">Regigration No</th>
			<th rowspan="1">Index No</th>
			<th rowspan="1">Attendence</th>
		</tr>
		<?php
		$query = "SELECT `studentenrolment`.`regNo` , `studentenrolment`.`indexNo` , `studentenrolment`.`acYear`,
		 `subject`.`nameEnglish` ,`studentenrolment`.`subjectID`FROM `studentenrolment`left JOIN `subject` ON
		  `studentenrolment`.`subjectID`= `subject`.`subjectID`WHERE `subject`.`faculty`='$faculty' and `subject`.`level`
		   = '$level' and `subject`.`semester` = '$semester' and `studentenrolment`.`acYear` = '$acyear'and
		 `studentenrolment`.`subjectID` = '$SubjectID' ";
		$result = $db->executeQuery($query);
		while ($row = $db->Next_Record($result)) {
		?>
			<tr>
				<td rowspan="1"><?php echo $row['regNo']  ?></td>
				<td rowspan="1"><input type="text" id="indexNo" name="indexNo" value="<?php echo $row['indexNo'] ?>" style="display: none;"><?php echo $row['indexNo'] ?></td>
				<input type="text" id="Year" name="Year" value="<?php echo $row['acYear'] ?>" style="display: none;">
				<input type="text" id="subjectid" name="subjectid" value="<?php echo $row['subjectID'] ?>" style="display: none;">
				<td rowspan="1">
					<select name="chk[]">
						<?php for ($sen = 1; $sen <= 100; $sen++) { ?><option value="<?php echo ($sen) . ";" . $row['indexNo']
						. ";" . $row['acYear'] . ";" . $row['subjectID'] ?>"><?php echo ($sen);  ?>%</option>
						<?php } ?>
					</select>
				</td>
			</tr>
		<?php

		}
		?>
	</table>
	<br /><br />
	<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'home.php';" class="button" />
		&nbsp;&nbsp;&nbsp;<input name="number" type="submit" value="submit" class="button" /></p>
</form>
<?php
?>