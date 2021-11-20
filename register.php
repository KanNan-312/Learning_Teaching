<?php
	if(isset($_GET["class"]) and isset($_SESSION["id"]) and isset($_GET["credits"]) and isset($_GET["flag"])){
		$class = $_GET["class"];
		$id = $_SESSION["id"];
		$credits = $_GET["credits"];
		$flag = $_GET["flag"];
		if($flag) {
			$student_id = $_SESSION["id"];
			$sql = "call studentCancel('$credits', '$id', '$class');";
			$result = $conn->query($sql);
		}
		else {
			$student_id = $_SESSION["id"];
			$sql = "call studentRegister('$credits', '$id', '$class');";
			$result = $conn->query($sql);
		}
	}
?>

<div class="course-container">
	<p style="font-size: 30px;"> Semester 211 </p>
	<table id="table">
	<tr>
		<th>Class</th>
		<th>Subject</th>
		<th>Credits</th>
		<th>Select</th>
	</tr>
	<?php
		$student_id = $_SESSION["id"];
		$sql = "call showRegisterPage($student_id);";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$flag = $row['flag'];
				echo "
					<tr>
						<td>".$row['Class']."</td>
						<td>".$row['Subject']."</td>
						<td>".$row['Credits']."</td>
						<td><button><a class='no-style-hyperlink' href='index.php?page=register&class=".$row['Class']."&credits=".$row['Credits']."&flag=".$row['flag']."'>
						". ($flag ? "Cancel" : "Submit") . "</a></button></td>
					</tr>
				";
			}
		}
	?>	
	</table>
</div>