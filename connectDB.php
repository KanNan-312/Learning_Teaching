<?php
    $servername = "localhost";
    $username = "root";
    $password = ""; # MySQL Password here
    $dbname = "learning_teaching";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>