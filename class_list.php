<div class="course-container">
    <?php
    $code = $_GET['code'];
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
            $result = $conn -> query($sql);
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
            $sql = "call showStudentList('$code');";
            $result = $conn -> query($sql);
            echo $sql;
            if (!$result)
                die(!$result->error);
            if ($result->num_rows > 0) {
                while($row = $result -> fetch_assoc())
                {
                    echo "
                    <tr>
                        <td>".$row['Name']."</td>
                        <td>".$row['ID']."</td>
                        <td>".$row['Email']."</td>
                    </tr>
                    ";
                }
            }
        ?>
        <hr>
    </table>
</div>