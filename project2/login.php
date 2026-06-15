<?php
session_start();
 
if (isset($_SESSION['manager_logged_in']) && $_SESSION['manager_logged_in'] == true) {
    header("Location: manage.php");
    exit();
}
 
require_once 'settings.php';
require_once 'admin.php';  // inserting username & hased pwd into database if not exist
 
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim(stripslashes($_POST['username'] ?? ''));
    $password = trim($_POST['password'] ?? '');
 
    if (empty($username) || empty($password)) {
        $error_message = "Both username and password are required.";
    } else {
        $conn = mysqli_connect($host, $user, $pwd, $sql_db);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            // using prepared statements
            $stmt = $conn->prepare("SELECT * FROM admin_login WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
 
            if ($row && password_verify($password, $row['pwd'])) {
                // Regenerate session ID on login to prevent session fixation
                session_regenerate_id(true);
                $_SESSION['manager_logged_in'] = true;
                $_SESSION['manager_username']  = $row['username'];

                $stmt->close();
                mysqli_close($conn);

                header("Location: manage.php");
                exit();
            } else {
                // Same message whether username or password is wrong
                $error_message = "Invalid username or password.";
            }
 
            $stmt->close();
            mysqli_close($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | NextGenDevs</title>
    <link rel="icon" type="image/x-icon" href="images/logo.ico">
    <link rel="stylesheet" href="styles/styles.css?v=<?php echo time(); ?>">
</head>
<body class="login-page">
    <div class="card-container">
            <section class="card-header">

                <div class="logo-login">
                    <a href="index.php" class="logo">
                        <img src="images/logo.png" alt="NextGen Devs logo" loading="eager">
                    <span>NextGen Devs</span>
                    </a>
                </div>
                
                <h1 class="main-title">Log In</h1>
                <p class="sub-title">HR Manager access only</p>
            </section>

            <section class="card-body">
                <form class="login-form" method="POST" action="login.php" novalidate>

                    <?php if (!empty($error_message)): ?>
                    <div class="error-alert">
                        <?= htmlspecialchars($error_message) ?>
                    </div>
                    <?php endif; ?>

                    <div class="input-group">
                        <input
                            type="text"
                            name="username"
                            placeholder="Username"
                            value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                            autocomplete="username"
                        >
                    </div>

                    <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            autocomplete="current-password"
                        >
                    </div>

                    <button type="submit" class="submit-btn">SIGN IN</button>

                </form>
        </section>
    </div>
</body>
</html>