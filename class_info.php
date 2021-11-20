<div class="info-container"> 
    <?php
        // Backend required
        $sql = "SELECT DISTINCT C.*, S.Name AS Subject_name, S.Num_credits, S.Faculty, T.Name AS Teacher_name FROM (TEACHER T JOIN CLASS C JOIN SUBJECT S ON T.Id = C.Main_teacher_id AND C.Subject_code = S.Code) WHERE C.Semester = '201' AND T.Id = '20' AND C.Code ='" . $_GET['code'] ."';";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "
                    <p class='info-header'><b>Class Code:</b></p>
                    <p class='info-value'>" . $row['Code'] ."</p>
                    <br>
                    <hr>
                    <p class='info-header'><b>Semester:</b></p>
                    <p class='info-value'>" . $row['Semester'] ."</p>
                    <br>
                    <hr>
                    <p class='info-header'><b>Subject:</b></p>
                    <p class='info-value'>" . $row['Subject_name'] ."</p>
                    <br>
                    <hr>
                    <p class='info-header'><b>Faculty:</b></p>
                    <p class='info-value'>" . $row['Faculty'] ."</p>
                    <br>
                    <hr>
                ";
            }
        }
        else {
            echo "<h1>Can't find this course</h1>";
        }
    ?>
</div>