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
        "phone" => "Phone Number"
    ];

    $pattern = [
        "jobref" => "/^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]{5}$/",
        "fname" => "/^[A-Za-z ]{1,20}$/",
        "lname" => "/^[A-Za-z ]{1,20}$/",
        "dob" => "/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",
        "postcode" => "/^[0-9]{4}$/",
        "phone" => "/^[0-9]{8,12}$/"
    ];

    $allowed = [
        "gender" => ["male","female","prefer-not-to-say"],
        "state" => ["VIC","NSW","QLD","NT","WA","SA","TAS","ACT"],
        "skill" => ["excel","mysql","python","java","spss","other"]
    ];

    $error_msg = [
        "fname" => "First name must be max 20 letters only.",
        "lname" => "Last name must be max 20 letters only.",
        "dob" => "Date of birth must be in dd/mm/yyyy format.",
        "postcode" => "Postcode must be exactly 4 digits.",
        "email" => "Invalid email format.",
        "phone" => "Phone number must be 8-12 digits.",
        "skill" => "At least one skill must be selected."
    ];

    $errors = [];
    $user_input = [];

    foreach ($fields as $field) {

        $user_input[$field] = sanitise_input($_POST[$field] ?? "");

        if (empty($user_input[$field])) {
            $errors[$field] = "$labels[$field] is required.";
            continue;
        }

        if (isset($pattern[$field]) &&
            !preg_match($pattern[$field], $user_input[$field])) {
            $errors[$field] = $error_msg[$field];
        }

        if (isset($allowed[$field]) &&
            !in_array($user_input[$field], $allowed[$field])) {
            $errors[$field] = "Invalid $labels[$field] selected.";
        }

        if ($field === "email" && !filter_var($user_input["email"], FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = $error_msg["email"];
        }
    }

    if (empty($_POST["skill"])) {
        $errors["skill"] = $error_msg["skill"];
        $user_input["skill"] = [];
    }
    else {
        $skill = $_POST["skill"];
        $valid = true;

        foreach ($skill as $s) {
            if (!in_array($s, $allowed["skill"])) {
                $valid = false;
                break;
            }
        }

        if (!$valid) {
            $errors["skill"] = "Invalid skill selected.";
            $user_input["skill"] = [];
        } else {
            $user_input["skill"] = array_map("sanitise_input", $skill);
        }
    }

    $user_input["others"] = sanitise_input($_POST["others"] ?? "");

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        $_SESSION["form_data"] = $user_input;

        session_write_close();

        header("Location: apply.php");
        exit();
    }

    foreach ($user_input as $field => $value) {
        if ($field === "skill") {
            $value = implode(", ", $value);
        }

        $$field = $value;
    }

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO eoi
        (
            jobref,
            fname,
            lname,
            dob,
            gender,
            street,
            suburb,
            state,
            postcode,
            email,
            phone,
            skill,
            others
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sssssssssssss",
        $jobref,
        $fname,
        $lname,
        $dob,
        $gender,
        $street,
        $suburb,
        $state,
        $postcode,
        $email,
        $phone,
        $skill,
        $others
    );

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        $eoi_number = mysqli_insert_id($conn);

        echo "<h1>Application Submitted Successfully</h1>";
        echo "<p>Your EOI Number is: $eoi_number</p>";
        echo "<p><a href='index.php'>Return Home</a></p>";
    }

    else {
        echo "Database error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);

    mysqli_close($conn);
?>