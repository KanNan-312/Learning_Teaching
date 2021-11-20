<?php
	$sql = 'select c.code as "Class", s.name as "Subject", s.num_credits as "Credits" 
    from class c, subject s
    where c.subject_code = s.code and c.semester = "202" limit 4;'


?>
<?php
			$sql = 'select c.code as "Class", s.name as "Subject", s.num_credits as "Credits" 
			from class c, subject s
			where c.subject_code = s.code and c.semester = "202" limit 4;';
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "

					";
				}
			}
		?>
<div class="course-container">
	<?php include "choose_semester.php" ?>
	<hr>
	<table id="register">
	<tr>
		<th>Class</th>
		<th>Subject</th>
		<th>Credits</th>
		<th>Select</th>
	</tr>
	<?php
		$sql = 'select c.code as "Class", s.name as "Subject", s.num_credits as "Credits" 
		from class c, subject s
		where c.subject_code = s.code and c.semester = "202" limit 4;';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "
					<tr>
						<td>".$row['Class']."</td>
						<td>".$row['Subject']."</td>
						<td>".$row['Credits']."</td>
						<td><button>Submit</button></td>
					</tr>
				";
			}
		}
	?>	
	</table>
</div>