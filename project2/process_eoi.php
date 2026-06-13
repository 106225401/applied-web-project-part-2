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

    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $fields = [
        "jobref",
        "fname",
        "lname",
        "dob",
        "gender",
        "street",
        "suburb",
        "state",
        "postcode",
        "email",
        "phone"
    ];

    $labels = [
        "jobref" => "Job Reference Number",
        "fname" => "First Name",
        "lname" => "Last Name",
        "dob" => "Date of Birth",
        "gender" => "Gender",
        "street" => "Street Address",
        "suburb" => "Suburb",
        "state" => "State",
        "postcode" => "Postcode",
        "email" => "Email",
        "phone" => "Phone"
    ];

    $validation = [
        "fname" => "/^[A-Za-z ]{1,20}$/",
        "lname" => "/^[A-Za-z ]{1,20}$/",
        "dob" => "/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",
        "postcode" => "/^[0-9]{4}$/",
        "phone" => "/^[0-9]{8,12}$/"
    ];

    $invalid_msg = [
        "fname" => "First name must be max 20 letters only.",
        "lname" => "Last name must be max 20 letters only.",
        "dob" => "Date of birth must be in dd/mm/yyyy format.",
        "postcode" => "Postcode must be exactly 4 digits.",
        "email" => "Invalid email format.",
        "phone" => "Phone number must be 8-12 digits.",
        "skill" => "At least one skill must be selected."
    ];

    $_SESSION["form_data"] = $_POST;

    $errors = [];
    $user_input = [];

    foreach ($fields as $field) {

        $$field = sanitise_input($_POST[$field] ?? "");
        $user_input[$field] = $$field;

        if (empty($user_input[$field])) {
            $errors[$field] = "$labels[$field] is required.";
            continue;
        }

        if (isset($validation[$field]) &&
            !preg_match($validation[$field], $user_input[$field])) {
            $errors[$field] = $invalid_msg[$field];
        }
    }

    if (!filter_var($user_input[$email], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = $invalid_msg["email"];
    }

    if (empty($_POST["skill"])) {
        $errors["skill"] = $invalid_msg["skill"];
        $user_input["skill"] = [];
    }
    else {
        $user_input["skill"] = $_POST["skill"];
    }
    $skill = implode(", ", array_map("sanitise_input", $_POST["skill"] ?? []));
    $others = sanitise_input($_POST["others"] ?? "");
    $user_input["others"] = $others;

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        $_SESSION["form_data"] = $user_input;

        session_write_close();

        header("Location: apply.php");
        exit();
    }
?>