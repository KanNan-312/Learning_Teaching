<?php
	if(isset($_GET["semester"])) {
		$semester = $_GET["semester"];
	}
	else {
		$semester = '211';
	}
?>
<script>
	$(function(){
		// bind change event to select
		$('#dynamic_select').on('change', function () {
			var url = $(this).val(); // get selected value
			if (url) { // require a URL
				window.location = url; // redirect
			}
			return false;
		});
	});
</script>
<div class="course-container">
	<p style="float: left; margin-right: 10px; font-size: 30px;"><b>Current semester:</b></p>
	<p style="font-size: 30px;"><?php echo $semester ?>
	<div class="select-dropdown">
		<select id="dynamic_select">
			<option value="" selected>Choose semester</option>
			<?php
				$sems = ['191','192','201','202','211'];
					foreach($sems as $sem) {
						echo "
							<option value='index.php?page=course&semester=" . $sem . "'>" . $sem . "</option>
						";
					}

			?>
		</select>
	</div>
	<hr>
	<div class="row">
		<?php
			if ($_SESSION['role'] == 'student')
			{
				$sql = "CALL showStudentCourse(" . $_SESSION['id'] . ",". $semester . ")";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "
							<div class='col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4'>
								<div class='course-box'><a href='index.php?page=course_info&code=" . $row['Code'] . "' class='no-style-hyperlink'>
									<p><b>Subject: " . $row['Subject'] . "(" . $row['Subject_id'] . ")</b></p>
									<hr>
									<p>Class code: " . $row['Code'] . "</p>
								</a></div>
							</div>
						";
					}

					// Show total number of credits
					// $id = $_SESSION['id'];
					// $sql2 = "SELECT * from learning_teaching.studystatus where Student_id=$id and Semester=$semester";
					// $result = $conn->query($sql2);
					// if ($result -> num_rows > 0 )
					// {
					// 	$row = $result -> fetch_assoc();
					// 	echo "<b> Total number of credits: </b>" . $row['Num_credits'];
					// }
				}
				else {
					echo "<p>You have no class in this semester</p>";
				}
			}
			else if ($_SESSION['role'] == 'teacher') {
				echo "This is teacher role";
				$sql = "CALL GetClassOfTeacher(" . $_SESSION['id'] . ",". $semester . ")";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "
							<div class='col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4'>
								<div class='course-box'><a href='index.php?page=course_info&code=" . $row['Code'] . "' class='no-style-hyperlink'>
									<p><b>Subject: " . $row['Subject'] . "(" . $row['Subject_code'] . ")</b></p>
									<hr>
									<p>Class code: " . $row['Code'] . "</p>
								</a></div>
							</div>
						";
					}
				}
			}
		?>
	</div>
</div>