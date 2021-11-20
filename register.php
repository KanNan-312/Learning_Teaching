<div class="course-container">
	<p style="font-size: 30px;"> Semester 211 </p>
	<table id="register">
	<tr>
		<th>Class</th>
		<th>Subject</th>
		<th>Credits</th>
		<th>Select</th>
	</tr>
	<?php
		$sql = 'call showRegisterPage()';
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