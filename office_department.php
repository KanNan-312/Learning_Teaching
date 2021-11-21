<div class="course-container">
    <p style="font-size: 30px;">Department list</p>
	<table id="table">
        <tr>
            <th>Name</th>
            <th>Link</th>
        </tr>
    <?php
        if ($_SESSION['role'] == 'office') {
            $sql = "CALL showAllFaculty()";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $name = $row['Name'];
                    echo "
                    <tr>
                        <td>$name</td>
                        <td><a href='index.php?page=office_course&name=$name'><button>View department</button></a></td>
                    </tr>
                    ";
                }
            }
        }
    ?>
</div>