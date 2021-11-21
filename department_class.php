<div class="course-container">
    <?php
        $semester = $_GET['semester'];
        $subject_code = $_GET['code'];
        if(isset($_GET["action"])) {
            $class_code = $_GET["class_code"];
            if($_GET["action"] == "add") {
                $teacher_id = $_GET["teacher_id"];
                $sql = "call AddClass('$class_code','$semester','$subject_code','$teacher_id')";
                if(!$result = $conn->query($sql)) {
                    print($sql);
                    die("Can't add syllabus! " . $result->error);
                }
            }
            else if($_GET["action"] == "remove") {
                $sql = "";
                if(!$result = $conn->query($sql)) {
                    die("Can't remove syllabus! " . $result->error);
                }
            }
            else {
                die("Invalid syllabus action!");
            }
            echo "<script>window.history.pushState('', '', 'index.php?page=class_list');</script>";
        }
    ?>
    <p style="font-size: 30px;"><b>All classes</b>: <?php echo $_GET['name']; ?></p>
	<table id="table">
        <tr>
            <th>Class ID</th>
            <th></th>
        </tr>
    <?php
        if ($_SESSION['role'] == 'department') {
            $sql = "CALL showClassesFaculty('$subject_code', '$semester')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $cnt = 1;
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>". $row['Class']. "</td>
                        <td><a href='index.php?page=class_list&code=". $row['Class'] . "&semester=" . $semester ."'><button>Class detail</button></a></td>";
                        if($semester == "211" && $cnt > 1) echo "<td><button><a class='no-style-hyperlink' href='index.php?page=department_class&class_id=".$row['Class']."&action=remove'>
                        Remove</a></button></td>";
                    "</tr>
                    ";
                    $cnt += 1;
                }
            }
            echo "</table><hr>";
            if($semester == "211") echo "
                <p style='font-size: 30px;'><b>New class</b></p>
                <table id='table'>
                    <tr>
                        <th>Class Code</th>
                        <th>Teacher ID</th>
                        <th></th>
                    </tr>
                    <form action='index.php' action='get'>
                        <tr id='form-tr'>
                            <input id='page' name='page' value='department_class' type='hidden'>
                            <input id='page' name='page' value='department_class' type='hidden'>
                            <td><input id='class_code' name='class_code' type='text' placeholder='Class Code ...'></td>
                            <td><input id='teacher_id' name='teacher_id' type='text' placeholder='Teacher ID ...'></td>
                            <input id='action' name='action' value='add' type='hidden'>
                            <td><button type='submit'>Add</button></td>
                        </tr>
                    <form>
                </table><hr>
            ";
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