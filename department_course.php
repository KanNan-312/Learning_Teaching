<div class="course-container">
    <?php
        $faculty = $_SESSION["user_real_name"];
        if($faculty == "Faculty of CS" or $faculty == "Computer Science & ") {
            $faculty = "Computer Science & Engineering";
        }
        else if($faculty == "Faculty of AS" or $faculty == "Applied Math & ") {
            $faculty = "Applied Math & Science";
        }
        else if($faculty == "Faculty of ME") {
            $faculty = "Mechatronic Engineering";
        }
        $more = "&name=$faculty";
        include "choose_semester.php";
    ?>
    <hr>
    <p style="font-size: 30px;"><b>All subjects</b></p>
	<table id="table">
        <tr>
            <th>Subject name</th>
            <th>Subject code</th>
            <th></th>
        </tr>
    <?php
        if ($_SESSION['role'] == 'department') {
            $sql = "CALL showSubjectFaculty('$faculty', '$semester')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                     $name = $row["Name"];
                     $code = $row["Code"];
                    echo "
                    <tr>
                        <td>$name</td>
                        <td>$code</td>
                        <td><a href='index.php?page=department_class&code=$code&semester=". $semester . "&name=" . $name . "'><button>View all classes</button></a></td>
                    </tr>
                    ";
                }
            }
            echo "</table>";
            $conn -> next_result();
            $sql = "CALL totalSubjectFaculty('$faculty', '$semester')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result -> fetch_assoc();
                $count = $row['no_subjects'];
                echo "<hr><p style='font-size: 30px;'><b>Total number of subjects</b>: $count</p>";
            }

        }
    ?>
</div>