<?php
    session_start();

<<<<<<< HEAD
    // Load database configuration
    require_once("settings.php");

    // Ensure page is accessed via POST only
=======
    require_once("settings.php");

>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: apply.php");
        exit();
    }

<<<<<<< HEAD
    // Establish database connection for storing form submissions
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

<<<<<<< HEAD
    // Create table if it doesn't exist
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
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

<<<<<<< HEAD
    // Function to sanitise input (trim, strip slashes, escape HTML)
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

<<<<<<< HEAD
    // Fields expected from form (excluding skill and others handled separately)
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
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

<<<<<<< HEAD
    // Labels used for error messages
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
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

<<<<<<< HEAD
    // Regex validation rules for specific fields
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
    $pattern = [
        "jobref" => "/^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]{5}$/",
        "fname" => "/^[A-Za-z ]{1,20}$/",
        "lname" => "/^[A-Za-z ]{1,20}$/",
        "dob" => "/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",
        "postcode" => "/^[0-9]{4}$/",
        "phone" => "/^[0-9]{8,12}$/"
    ];

<<<<<<< HEAD
    // Allowed dropdown / checkbox values
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
    $allowed = [
        "gender" => ["male","female","prefer-not-to-say"],
        "state" => ["VIC","NSW","QLD","NT","WA","SA","TAS","ACT"],
        "skill" => ["excel","mysql","python","java","spss","other"]
    ];

<<<<<<< HEAD
    // Custom error messages
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
    $error_msg = [
        "fname" => "First name must be max 20 letters only.",
        "lname" => "Last name must be max 20 letters only.",
        "dob" => "Date of birth must be in dd/mm/yyyy format.",
        "postcode" => "Postcode must be exactly 4 digits.",
        "email" => "Invalid email format.",
        "phone" => "Phone number must be 8-12 digits.",
        "skill" => "At least one skill must be selected."
    ];

<<<<<<< HEAD
    // Stores validation errors
    $errors = [];

    // Stores sanitised input values
    $user_input = [];

    // Validate normal input fields
    foreach ($fields as $field) {

        // Sanitise user input
        $user_input[$field] = sanitise_input($_POST[$field] ?? "");

        // Required field check
=======
    $errors = [];
    $user_input = [];

    foreach ($fields as $field) {

        $user_input[$field] = sanitise_input($_POST[$field] ?? "");

>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
        if (empty($user_input[$field])) {
            $errors[$field] = "$labels[$field] is required.";
            continue;
        }

<<<<<<< HEAD
        // Pattern validation
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
        if (isset($pattern[$field]) &&
            !preg_match($pattern[$field], $user_input[$field])) {
            $errors[$field] = $error_msg[$field];
        }

<<<<<<< HEAD
        // Allowed value validation
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
        if (isset($allowed[$field]) &&
            !in_array($user_input[$field], $allowed[$field])) {
            $errors[$field] = "Invalid $labels[$field] selected.";
        }

<<<<<<< HEAD
        // Email format validation
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
        if ($field === "email" && !filter_var($user_input["email"], FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = $error_msg["email"];
        }
    }

<<<<<<< HEAD
    // Handle checkbox input separately because skill is an array, unlike other form fields
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
    if (empty($_POST["skill"])) {
        $errors["skill"] = $error_msg["skill"];
        $user_input["skill"] = [];
    }
    else {
        $skill = $_POST["skill"];
<<<<<<< HEAD

        // Validate each selected skill
        $valid = true;
=======
        $valid = true;

>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
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

<<<<<<< HEAD
    // Other skills field
    $user_input["others"] = sanitise_input($_POST["others"] ?? "");

    // If validation fails, redirect back with errors
    if (!empty($errors)) {

        // Store validation errors and user input in session to repopulate form after redirect
=======
    $user_input["others"] = sanitise_input($_POST["others"] ?? "");

    if (!empty($errors)) {
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
        $_SESSION["errors"] = $errors;
        $_SESSION["form_data"] = $user_input;

        session_write_close();

        header("Location: apply.php");
        exit();
    }

<<<<<<< HEAD
    // Convert validated input array into variables for prepared statement binding
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
    foreach ($user_input as $field => $value) {
        if ($field === "skill") {
            $value = implode(", ", $value);
        }

<<<<<<< HEAD
        $$field = $value;
    }

    // Insert validated form data into database using prepared statement (prevents SQL injection)
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

    // Bind parameters to query
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

    // Execute prepared statement and insert data into database
    $result = mysqli_stmt_execute($stmt);

    // Retrieve auto-generated EOInumber after successful insert
    if ($result) {
        $eoi_number = mysqli_insert_id($conn);
    }
    
    else {
        die("Database error: " . mysqli_error($conn));
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Application confirmation page">
        <meta name="keywords" content="job application, confirmation, EOI">
        <meta name="author" content="Jingyee">

        <!-- Tab bar: title and icon -->
        <title>Application Successful</title>
        <link rel="icon" type="image/x-icon" href="images/logo.ico">

        <!-- Link to external CSS -->
        <link rel="stylesheet" href="styles/styles.css?v=<?= filemtime('styles/styles.css') ?>">
    </head>

    <body>
        <main id="main">
            <!-- Confirmation heading -->
            <h1 class="success-header">Application Submitted Successfully</h1>

            <!-- EOI number display -->
            <p class="eoi-no">
                Your EOI Number is: <?= htmlspecialchars($eoi_number) ?>
            </p>

            <!-- Link to homepage -->
            <p class="return-link">
                <a href="index.php">Return Home</a>
            </p>
        </main>
    </body>
</html>
=======
        $$field = mysqli_real_escape_string($conn, $value);
    }

    $sql = "
    INSERT INTO eoi
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
    VALUES
    (
        '$jobref',
        '$fname',
        '$lname',
        '$dob',
        '$gender',
        '$street',
        '$suburb',
        '$state',
        '$postcode',
        '$email',
        '$phone',
        '$skill',
        '$others'
    )
    ";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $eoi_number = mysqli_insert_id($conn);

        echo "<h1>Application Submitted Successfully</h1>";
        echo "<p>Your EOI Number is: $eoi_number</p>";
        echo "<p><a href='index.php'>Return Home</a></p>";
    }

    else {
        echo "Database error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
