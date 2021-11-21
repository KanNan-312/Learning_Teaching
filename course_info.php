<?php
    if(isset($_GET["action"])) {
        if($_GET["action"] == "add") {
            $sql = "INSERT INTO test_syllabus(isbn, name) values('".$_GET['isbn']."', '".$_GET['name']."');";
            if(!$result = $conn->query($sql)) {
                print($sql);
                die("Can't add syllabus! " . $result->error);
            }
        }
        else if($_GET["action"] == "remove") {
            $sql = "DELETE FROM test_syllabus WHERE isbn = ".$_GET['isbn'].";";
            if(!$result = $conn->query($sql)) {
                die("Can't remove syllabus! " . $result->error);
            }
        }
        else {
            die("Invalid syllabus action!");
        }
        echo "<script>window.history.pushState('', '', 'index.php?page=course_info');</script>";
    }
?>
<div class="info-container">
    <?php
        if($_SESSION["role"] == "student") {
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
        }
        else if($_SESSION["role"] == "teacher") {
            echo "
                <table id='table'>
                <tr>
                    <th>ISBN</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>";
                $student_id = $_SESSION["id"];
                $sql = "SELECT * FROM learning_teaching.test_syllabus;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>".$row['isbn']."</td>
                                <td>".$row['name']."</td>
                                <td><button><a class='no-style-hyperlink' href='index.php?page=course_info&isbn=".$row['isbn']."&action=remove'>
                                Remove</a></button></td>
                            </tr>
                        ";
                    }
                }
                echo "
                    <form action='index.php' action='get'>
                        <tr id='form-tr'>
                            <input id='page' name='page' value='course_info' type='hidden'>
                            <td><input id='isbn' name='isbn' type='text' placeholder='ISBN ...'></td>
                            <td><input id='name' name='name' type='text' placeholder='Syllabus ...'></td>
                            <input id='action' name='action' value='add' type='hidden'>
                            <td><button type='submit'>Add</button></td>
                        </tr>
                    <form>
            </table>";
        }
    ?>
</div>