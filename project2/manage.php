<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage</title>
    <style>
        h1 {
            text-align: center;
            margin-bottom: 28px;
            font-size: 24px;
        }
        form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        label {
            font-size: 18px;
        }
        input[type="text"],
        input[type="password"] {
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
            margin-bottom: 18px;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #4f46e5;
        }
        input[type="submit"] {
            padding: 12px;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
    </style>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Submit">
    </form>
</body>
</html>