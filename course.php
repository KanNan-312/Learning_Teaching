<div class="course-container">
	<?php include "choose_semester.php" ?>
	<hr>
	<div class="row">
		<?php
			$sql = "CALL GetListOfSubjectsOfSemester(" . $semester . ")";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "
						<div class='col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4'>
							<div class='course-box'><a href='index.php?page=course_info&code=" . $row['Code'] . "' class='no-style-hyperlink'>
								<p><b>Name: " . $row['Name'] . "</b></p>
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