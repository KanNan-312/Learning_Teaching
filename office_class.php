<div class="course-container">
    <?php
        $semester = $_GET['semester'];
        $subject_code = $_GET['code'];
    ?>
    <hr>
    <p style="font-size: 30px;">All classes</p>
	<table id="table">
        <tr>
            <th>Class</th>
            <th></th>
        </tr>
    <?php
        echo "Classes list: " . $_GET['name'];
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
            // total class of subject
            $conn -> next_result();
            $sql = "CALL totalClassSubject('$subject_code', '$semester')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result -> fetch_assoc();
                $count = $row['no_classes'];
                echo "<br><br>Total number of classes:". $count ;
            }
            // total student of subject
            $conn -> next_result();
            $sql = "CALL totalStudentSubject('$subject_code', '$semester')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result -> fetch_assoc();
                $count = $row['students'];
                echo "<br><br>Total number of :". $count ;
            }
        }
    ?>
</div>