<div class="course-container">
	<p style="font-size: 30px;"> Semester 211 </p>
	<table id="table">
        <tr>
            <th>Name</th>
            <th>Student ID</th>
            <th>Email</th>
        </tr>
        <?php
            $code = $_GET['code'];
            $sql = "call showStudentList('$code');";
            $result = $conn -> query($sql);
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