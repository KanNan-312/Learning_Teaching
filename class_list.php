<div class="course-container">
    <?php
        $semester = $_GET['semester'];
        echo $semester;
        $code = $_GET['code'];
        $can_modify_student = ($_SESSION["role"] == "office" and $semester == "211") ? true : false;
        if(isset($_GET["action"])) {
            $student_id = $_GET['student_id'];
            if($_GET["action"] == "add") {
                $student_id = $_GET["student_id"];
                $sql = "";
                if(!$result = $conn->query($sql)) {
                    print($sql);
                    die("Can't add syllabus! " . $result->error);
                }
            }
            else if($_GET["action"] == "remove") {
                $student_id = $_GET["student_id"];
                $student_name = $_GET["student_name"];
                $student_name = $_GET["student_email"];
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
    <p style="font-size: 30px;">Lecturer list</p>
	<table id="table">
        <tr>
            <th>Name</th>
            <th>Teacher ID</th>
            <th>Role</th>
        </tr>
        <?php
            $sql = "call showTeacherList('$code');";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result -> fetch_assoc())
                {
                    echo "
                    <tr>
                        <td>".$row['Name']."</td>
                        <td>".$row['ID']."</td>
                        <td>".$row['Role']."</td>
                    </tr>
                    ";
                }
            }
        ?>
        <hr>
    </table>
	<p style="font-size: 30px;">Student list</p>
	<table id="table">
        <tr>
            <th>Name</th>
            <th>Student ID</th>
            <th>Email</th>
        </tr>
        <?php
            $conn->next_result(); // Fix multiple queries error
            $sql = "call showStudentList('$code');";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result -> fetch_assoc())
                {
                    echo "
                    <tr>
                        <td>".$row['Name']."</td>
                        <td>".$row['ID']."</td>
                        <td>".$row['Email']."</td>
                        <td><button><a class='no-style-hyperlink' href='index.php?page=class_list&student_id=".$row['Name']."&action=remove&code=$code'>
                        Remove</a></button></td>
                    </tr>
                    ";
                }
            }
            echo "
                <form action='index.php' action='get'>
                    <tr id='form-tr'>
                        <input id='page' name='page' value='class_list' type='hidden'>
                        <td><input id='student_name' name='student_name' type='text' placeholder='Name ...'></td>
                        <td><input id='student_id' name='student_id' type='text' placeholder='ID ...'></td>
                        <td><input id='student_email' name='student_email' type='email' placeholder='Email ...'></td>
                        <input id = 'code' name = 'code' value = $code type = 'hidden'>
                        <input id='action' name='action' value='add' type='hidden'>
                        <td><button type='submit'>Add</button></td>
                    </tr>
                <form>
                </table>
            ";
        ?>
        <hr>
    </table>
</div>