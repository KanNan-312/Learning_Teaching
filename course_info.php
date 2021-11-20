<div class="info-container">
    <?php
        // $sql = "SELECT * FROM learning_teaching.subject WHERE Code ='" . $_GET['code'] ."';";
        $sql = "call showCourseInfo(?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_GET['code']);
        $stmt -> execute();
        $result = $stmt -> get_result();
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "
                    <p class='info-header'><b>Subject code:</b></p>
                    <p class='info-value'>" . $row['Subject'] ."</p>
                    <br>
                    <hr>
                    <p class='info-header'><b>Class code:</b></p>
                    <p class='info-value'>" . $row['Code'] ."</p>
                    <br>
                    <hr>
                    <p class='info-header'><b>Number of credits:</b></p>
                    <p class='info-value'>" . $row['Credits'] ."</p>
                    <br>
                    <hr>
                    <p class='info-header'><b>Lecturer:</b></p>
                    <p class='info-value'>" . $row['Lecturer'] ."</p>
                    <br>
                    <hr>
                    <p class='info-header'><b>Syllabus:</b></p>
                    <p class='info-value'>" . $row['Syllabus'] ."</p>
                    <br>
                ";
            }
        }
        else {
            echo "<h1>Can't find this course</h1>";
        }
    ?>
</div>