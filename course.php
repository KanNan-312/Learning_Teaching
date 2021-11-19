<?php
	if(isset($_GET["semester"])) {
		$semester = $_GET["semester"];
	}
	else {
		$sql = "SELECT DISTINCT Semester FROM CLASS ORDER BY Semester DESC LIMIT 0,1";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$semester = $result->fetch_assoc()["Semester"];
		}
		else {
			die("Can't find any semester");
		}
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
	<select id="dynamic_select">
		<option value="" selected>Choose semester</option>
		<?php
			$sql = "SELECT DISTINCT Semester FROM CLASS ORDER BY Semester DESC";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "
						<option value='index.php?page=course&semester=" . $row["Semester"] . "'>" . $row["Semester"] . "</option>
					";
				}
			}
		?>
	</select>
	<div class="row">
		<?php
			$sql = "CALL GetListOfSubjectsOfSemester(" . $semester . ")";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "
						<div class='col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4'>
							<div class='course-box'>
								<p>Name: " . $row['Name'] . "</p>
								<p>Code: " . $row['Code'] . "</p>
							</div>
						</div>
					";
				}
			}
		?>
	</div>
</div>