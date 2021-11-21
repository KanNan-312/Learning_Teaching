<?php
	if(isset($_GET["semester"])) {
		$semester = $_GET["semester"];
	}
	else {
		$semester = '211';
	}
?>
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
				}
				else {
					echo "<p>You have no class in this semester</p>";
				}
			}
			else if ($_SESSION['role'] == 'teacher') {
				$sql = "CALL GetClassOfTeacher(" . $_SESSION['id'] . ",". $semester . ")";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo "
							<div class='col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4'>
								<div class='course-box'><a href='index.php?page=course_info&code=" . $row['Code'] . "&subject=" .$row['Subject'] . "&semester=" . $semester. "' class='no-style-hyperlink'>
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