<?php
    if ($_SESSION["role"] == 'teacher')
        $semester = $_GET['semester'];
    if(isset($_GET["action"])) {
        $code = $_GET['code'];
        $isbn = $_GET['isbn'];
        if($_GET["action"] == "add") {
            $title = $_GET['title'];
            $sql = "call addSyllabus('$code','$isbn','$title');";
            if(!$result = $conn->query($sql)) {
                print($sql);
                die("Can't add syllabus! " . $result->error);
            }
        }
        else if($_GET["action"] == "remove") {
            $sql = "call deleteSyllabus('$code', '$isbn');";
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
            $code = $_GET['code'];
            $subject = $_GET['subject'];
            $student_id = $_SESSION["id"];

            echo "<p class='info-header'><b>Class code:</b></p>
            <p class='info-value'>$code</p>
            <br>
            <hr>
            <p class='info-header'><b>Subject:</b></p>
            <p class='info-value'>$subject</p>
            <br>
            <hr>
            <p class='info-header'><b>Syllabus:</b></p>
            <table id='table'>
                <tr>
                    <th>ISBN</th>
                    <th>Name</th>";
                    if ($semester == "211") echo "<th>Modify</th>";
                echo "</tr>
            ";
            $sql = "call showSyllabus('$code');";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>".$row['ISBN']."</td>
                            <td>".$row['Title']."</td>";
                            if ($semester == "211") echo "<td><button><a class='no-style-hyperlink' href='index.php?page=course_info&isbn=".$row['ISBN']."&code=" . $code .
                            "&semester=" . $semester . "&subject=" . $subject . "&action=remove'>
                            Remove</a></button></td>";
                        echo "</tr>
                    ";
                }
            }
            if ($semester == "211") echo "
                <form action='index.php' action='get'>
                    <tr id='form-tr'>
                        <input id='page' name='page' value='course_info' type='hidden'>
                        <td><input id='isbn' name='isbn' type='text' placeholder='ISBN ...'></td>
                        <td><input id='title' name='title' type='text' placeholder='Title ...'></td>
                        <input id = 'semester' name = 'semester' value = $semester type = 'hidden'>
                        <input id = 'subject' name = 'subject' value = $subject type = 'hidden'>
                        <input id = 'code' name = 'code' value = $code type = 'hidden'>
                        <input id='action' name='action' value='add' type='hidden'>
                        <td><button type='submit'>Add</button></td>
                    </tr>
                <form>";
            echo "</table>
            <br>
            <hr>
            <a class='no-style-hyperlink' href='index.php?page=class_list&code=". $code. "&semester=" . $semester . "'> <div class='d-grid gap-2 col-6 mx-auto'>
                <button class='btn btn-primary' type='button'>
                    Class information
                </button>
            </div></a>
            ";
        }
    ?>
</div>