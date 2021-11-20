<div class="info-container">
    <?php
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
    ?>
</div>