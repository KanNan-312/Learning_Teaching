<div class="course-container">
    <?php
        // if office va semester = 211 display them cai cuc student (remove voi add).
    ?>
    <?php
        $semester = $_GET['semester'];
        $code = $_GET['code'];
        $can_modify_student = ($_SESSION["role"] == "office" and $semester == "211") ? true : false;
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
            <?php if($can_modify_student) echo "<th>Modify</th>"; ?>
        </tr>
        <?php
            $conn->next_result(); // Fix multiple queries error
            $sql = "call showStudentList('$code');";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result -> fetch_assoc())
                {
                    // echo "
                    // <tr>
                    //     <td>".$row['Name']."</td>
                    //     <td>".$row['ID']."</td>
                    //     <td>".$row['Email']."</td>
                    //     <td><button><a class='no-style-hyperlink' href='index.php?page=course_info&isbn=".$row['ISBN']."&action=remove&code=$code'>
                    //     Remove</a></button></td>
                    // </tr>
                    // ";
                }
            }
        ?>
        <hr>
    </table>
</div>