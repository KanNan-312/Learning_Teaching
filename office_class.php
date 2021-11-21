<div class="course-container">
    <?php
        $semester = $_GET['semester'];
        $subject_code = $_GET['code'];
    ?>
    <p style="font-size: 30px;"><b>Classes list of</b>: <?php echo $_GET['name']; ?></p>
	<table id="table">
        <tr>
            <th>Class ID</th>
            <th></th>
        </tr>
    <?php
        if ($_SESSION['role'] == 'office') {
            $sql = "CALL showClassesFaculty('$subject_code', '$semester')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>". $row['Class']. "</td>
                        <td><a href='index.php?page=class_list&code=". $row['Class'] . "&semester=" . $semester ."'><button>Class detail</button></a></td>
                    </tr>
                    ";
                }
            }
            echo "</table><hr>";
            // total class of subject
            $conn -> next_result();
            $sql = "CALL totalClassSubject('$subject_code', '$semester')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result -> fetch_assoc();
                $count = $row['no_classes'];
                echo "<p style='font-size: 30px;'><b>Total number of classes</b>: $count</p>";
            }
            // total student of subject
            $conn -> next_result();
            $sql = "CALL totalStudentSubject('$subject_code', '$semester')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result -> fetch_assoc();
                $count = $row['students'];
                echo "<p style='font-size: 30px;'><b>Total number of students</b>: $count</p>";
            }
        }
    ?>
</div>