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

<p style="float: left; margin-right: 10px; font-size: 30px;"><b>Current semester:</b></p>
<p style="font-size: 30px;"><?php echo $semester ?>
<div class="select-dropdown">
    <select id="dynamic_select">
        <option value="" selected>Choose semester</option>
        <?php
            $sql = "SELECT DISTINCT Semester FROM CLASS ORDER BY Semester DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
                        <option value='index.php?page=" . $direct . "&semester=" . $row["Semester"] . "'>" . $row["Semester"] . "</option>
                    ";
                }
            }
        ?>
    </select>
</div>