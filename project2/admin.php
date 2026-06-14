<?php
require_once 'settings.php';

$seedConn = mysqli_connect($host, $user, $pwd, $sql_db);
if (!$seedConn) {
    return;   
}

mysqli_query($seedConn, "CREATE TABLE IF NOT EXISTS admin_login (
        username VARCHAR(50)  NOT NULL PRIMARY KEY,
        pwd      VARCHAR(255) NOT NULL)");

// check if there's at least one record in the table
$query = mysqli_query($seedConn, "SELECT 1 FROM admin_login LIMIT 1"); 

// if there's no record, insert the values
if (mysqli_num_rows($query) == 0) {
    $accounts = [
        'Admin'     => 'Admin',
        'louis'     => 'Swin106399199',
        'jingyee'   => 'Swin106225401',
        'charlotte' => 'Swin106403058',
        'afif'      => 'Swin106201456'];

    $stmt = $seedConn->prepare("INSERT INTO admin_login (username, pwd) VALUES (?, ?)");
    $stmt->bind_param("ss", $u, $hash);  

    foreach ($accounts as $u => $plain) {
        $hash = password_hash($plain, PASSWORD_DEFAULT); 
        $stmt->execute();
    }
    $stmt->close();
}

mysqli_close($seedConn);
?>