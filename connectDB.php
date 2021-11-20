<?php
    $servername = "localhost";
    $username = "root";
    $password = "kth302110"; # MySQL Password here
    $dbname = "learning_teaching";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>