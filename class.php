<div class="course-container">
    <?php
        include "choose_semester.php";
    ?>
    <hr>
    <div class="row">
		<?php
            // Backend required
			$teacher_id = $_SESSION['id'];
			$sql = "CALL GetListOfClassesTaughtByTeacherOfSemester('$semester', '$teacher_id');";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "
						<div class='col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4'>
							<div class='course-box'><a href='index.php?page=class_info&subject=" . $row['Code'] . "&syllabus=" . $row['Main_teacher_id'] . "&semester=" . $row['Semester'] . "' class='no-style-hyperlink'>
								<p><b>Name: " . $row['Subject Name'] . "</b></p>
								<hr>
								<p>Code: " . $row['Code'] . "</p>
							</a></div>
						</div>
					";
				}
			}
		?>
	</div>
</div>