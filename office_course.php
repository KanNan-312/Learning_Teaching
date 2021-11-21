<div class="course-container">

    <?php
        $faculty = $_GET["name"];
        if($faculty == "Computer Science ") {
            $faculty = "Computer Science & Engineering";
        }
        else if($faculty == "Applied Math ") {
            $faculty = "Applied Math & Science";
        }

        $more = "&name=$faculty";
        include "choose_semester.php";

    ?>
    <hr>
    <p style="font-size: 30px;"><b>All subjects</b></p>
	<table id="table">
        <tr>
            <th>Subject code</th>
            <th>Subject name</th>
            <th></th>
        </tr>
    <?php
        if ($_SESSION['role'] == 'office') {
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
                        <td><a href='index.php?page=office_class&code=$code&semester=". $semester . "&name=" . $name . "'><button>View all classes</button></a></td>
                    </tr>
                    ";
                }
            }
            echo "</table>";

            echo "Statistics: <br>";
            // total subject in one semester
            $conn -> next_result();
            $sql = "CALL totalSubjectFaculty('$faculty', '$semester')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result -> fetch_assoc();
                $count = $row['no_subjects'];
                echo "<hr><p style='font-size: 30px;'><b>Total number of subjects</b>: $count</p>";
            }
            // total classes in one semester
            $conn -> next_result();
            $sql = "CALL totalClassFaculty('$faculty', '$semester')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result -> fetch_assoc();
                $count = $row['no_classes'];
                echo "<hr><p style='font-size: 30px;'><b>Total number of classes</b>: $count</p>";
            }

            // total student in one semester

        }
    ?>
</div>