<div class="course-container">
    <?php
        $faculty = $_GET["name"];
        if($faculty == "Computer Science ") {
            $faculty = "Computer Science & Engineering";
        }
        if($faculty == "Applied Math ") {
            $faculty = "Applied Math & Science";
        }

        $more = "&name=$faculty";
        include "choose_semester.php";

    ?>
    <hr>
    <p style="font-size: 30px;">Course list of <?php echo $faculty ?></p>
	<table id="table">
        <tr>
            <th>Course code</th>
            <th>Course name</th>
        </tr>
    <?php
        if ($_SESSION['role'] == 'office') {
            $sql = "CALL showSubjectFaculty('$faculty', '$semester')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $code = $row["Code"];
                    $name = $row["Name"];
                    echo "
                    <tr>
                        <td>$code</td>
                        <td>$name</td>
                    </tr>
                    ";
                }
            }
        }
    ?>
</div>