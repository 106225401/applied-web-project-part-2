<?php
    session_start();

    require_once("settings.php");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: apply.php");
        exit();
    }

    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $create_table = "
    CREATE TABLE IF NOT EXISTS eoi (
        EOInumber INT AUTO_INCREMENT PRIMARY KEY,
        jobref VARCHAR(5) NOT NULL,
        fname VARCHAR(20) NOT NULL,
        lname VARCHAR(20) NOT NULL,
        dob VARCHAR(10) NOT NULL,
        gender VARCHAR(20) NOT NULL,
        street VARCHAR(40) NOT NULL,
        suburb VARCHAR(40) NOT NULL,
        state VARCHAR(3) NOT NULL,
        postcode VARCHAR(4) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(12) NOT NULL,
        skill TEXT,
        others TEXT,
        status ENUM('New','Current','Final') DEFAULT 'New'
    )";
    mysqli_query($conn, $create_table);
?>