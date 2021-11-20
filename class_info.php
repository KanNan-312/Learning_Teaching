<div class="info-container"> 
    <?php
        // Backend required
        $sql = "";
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