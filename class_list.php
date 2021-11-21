<?php
$code = $_GET['code'];
$sql = "call showStudentList('$code');";
$result = $conn -> query($sql);
if ($result->num_rows > 0) {
    while($row = $result -> fetch_assoc())
    {
        echo $row['Name'];
        echo $row['ID'];
        echo $row['Email'];
        echo '<br>';
    }
}