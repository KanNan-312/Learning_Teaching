<div class="info-container">
    <?php
        if($_SESSION["role"] == "student") {
            $sql = "SELECT * FROM learning_teaching.subject WHERE Code ='" . $_GET['code'] ."';";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
                        <p class='info-header'><b>Course Name:</b></p>
                        <p class='info-value'>" . $row['Name'] ."</p>
                        <br>
                        <hr>
                        <p class='info-header'><b>Code:</b></p>
                        <p class='info-value'>" . $row['Code'] ."</p>
                        <br>
                        <hr>
                        <p class='info-header'><b>Number of credist:</b></p>
                        <p class='info-value'>" . $row['Num_credits'] ."</p>
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
        }
        else if($_SESSION["role"] == "teacher") {
            $teacher_id = $_GET["id"];
            $semester = $_GET["semester"];
            $course_id = $_GET["c_id"];
            $sql = "CALL GetSubjectAndSyllabus2('$teacher_id', '$semester', '$course_id')";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                echo "
                    <p class='info-header'><b>Syllabus:</b></p>
                    <table  id='table'>
                        <tr>
                            <th>Title</td>
                            <th>Isbn</th>
                        </tr>
                ";
                while($row = $result->fetch_assoc()) {
                    echo "
                        
                        <tr>
                            <td>".$row['title']."</td>
                            <td>".$row['isbn']."</td>
					    </tr>
                    ";
                }
                echo "
                    </table>
                    <br>
                    <hr>
                    <p class='info-header'><b>Syllabus:</b></p>
                    <p class='info-value'>" . $row['Syllabus'] ."</p>
                    <br>
                ";
            }
            else {
                echo "<h1>Can't find this course</h1>";
            }
        }

    ?>
</div>