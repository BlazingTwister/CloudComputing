<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $_SESSION['phone'] = $_POST['phone'];
    $_SESSION['age'] = $_POST['age'];

    // Redirect to login page after registration
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required><br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required><br>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
