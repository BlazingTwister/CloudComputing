<?php
session_start();

$generatedOTP = '123456';  // Mock OTP for testing, in a real scenario you would generate this dynamically and send via email

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $otp = $_POST['otp'];

    // Validate the email and password against the session
    if ($email == $_SESSION['email'] && password_verify($password, $_SESSION['password']) && $otp == $generatedOTP) {
        // Successful login
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid credentials or OTP.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="POST" action="">
            <label for="email">Email:</label>
            <input type="email" id="loginEmail" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" id="loginPassword" name="password" required><br>

            <button type="button" onclick="sendOTP()">Send OTP</button>

            <div id="otpSection" style="display:none;">
                <label for="otp">Enter OTP:</label>
                <input type="text" id="otp" name="otp" required><br>
                <button type="submit">Login</button>
            </div>
        </form>

        <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

    </div>

    <script>
        function sendOTP() {
            alert('OTP sent to your email!'); // Simulate OTP sending
            document.getElementById('otpSection').style.display = 'block';
        }
    </script>
</body>
</html>
