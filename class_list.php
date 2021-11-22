<div class="course-container">
    <?php
        $semester = $_GET['semester'];
        $code = $_GET['code'];
        // echo $semester;
        
        $can_modify_student = ($_SESSION["role"] === "office" and $semester === "211") ? true : false;
        if(isset($_GET["action"])) {
            // Get number of subject credits
            $sql = "select distinct s.num_credits from class c, subject s where c.code = '$code' and c.subject_code = s.code;";
            if(!$result = $conn->query($sql)) {
                print($sql);
                die("Can't find credit number! " . $result->error);
            }
            // $credits = 3;
            if ($result->num_rows > 0)
            {
                $row = $result -> fetch_assoc();
                $credits = $row['num_credits'];
            }
            $student_id = $_GET['student_id'];
            if($_GET["action"] == "add") {
                $conn -> next_result();
                $student_id = $_GET["student_id"];
                $sql = "call studentRegister ($credits, '$student_id', '$code')";
                if(!$result = $conn->query($sql)) {
                    print($sql);
                    die("Can't add student! " . $result->error);
                }
            }
            else if($_GET["action"] == "remove") {
                $conn -> next_result();
                $student_id = $_GET["student_id"];
                $sql = "call studentCancel ($credits, '$student_id', '$code')";
                if(!$result = $conn->query($sql)) {
                    die("Can't remove student! " . $result->error);
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
            <?php if($can_modify_student == True) echo "<th></th>" ?>
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
                        <td>".$row['Email']."</td>";
                        if($can_modify_student == True) echo "<td><button><a class='no-style-hyperlink' href='index.php?page=class_list&student_id=".$row['ID']. "&semester=". $semester
                         ."&action=remove&code=$code'>
                        Remove</a></button></td>";
                    echo "</tr>
                    ";
                }
            }
            if($can_modify_student == True) echo "
                <form action='index.php' action='get'>
                    <tr id='form-tr'>
                        <input id='page' name='page' value='class_list' type='hidden'>
                        <td></td>
                        <td><input id='student_id' name='student_id' type='text' placeholder='ID ...'></td>
                        <td></td>
                        <input id = 'code' name = 'code' value = $code type = 'hidden'>
                        <input id = 'semester' name = 'semester' value = $semester type = 'hidden'>
                        <input id='action' name='action' value='add' type='hidden'>
                        <td><button type='submit'>Add</button></td>
                    </tr>
                <form>";
                echo "</table>
            ";

            // total number of students of class
            // total student of subject
            $conn -> next_result();
            $sql = "CALL totalStudentClass('$code')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result -> fetch_assoc();
                $count = $row['Students'];
                echo "<p style='font-size: 30px;'><b>Total number of students</b>: $count</p>";
            }
        ?>
        <hr>
    </table>
</div>