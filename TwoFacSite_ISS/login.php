<?php
session_start();

function generateOTP() {
    return rand(100000, 999999); // Generate a random 6-digit OTP
}

function isOTPExpired($expirationTime) {
    return time() > $expirationTime; // Check if the current time is greater than the expiration time
}

// Check if OTP has been generated
if (isset($_SESSION['otp'])) {
    $otpExpirationTime = $_SESSION['otp_expiration'];
    
    // Check if OTP is expired
    if (isOTPExpired($otpExpirationTime)) {
        // OTP is expired, unset the session variable
        unset($_SESSION['otp']);
        unset($_SESSION['otp_expiration']);
    }
}

// Handle OTP request
if (isset($_POST['request_otp'])) {
    // Check if there's a cooldown
    if (isset($_SESSION['otp_request_time']) && time() < $_SESSION['otp_request_time'] + 60) {
        $remainingCooldown = ($_SESSION['otp_request_time'] + 60) - time();
        echo "You can request a new OTP in " . $remainingCooldown . " seconds.";
    } else {
        // Generate a new OTP
        $_SESSION['otp'] = generateOTP();
        $_SESSION['otp_expiration'] = time() + 60; // Set expiration time to 1 minute from now
        $_SESSION['otp_request_time'] = time(); // Set the time of the OTP request
        echo "Your OTP is: " . $_SESSION['otp']; // Display the OTP
    }
}

// Handle OTP verification
if (isset($_POST['verify_otp'])) {
    $userOTP = $_POST['otp'];
    
    if (isset($_SESSION['otp']) && !isOTPExpired($_SESSION['otp_expiration'])) {
        if ($userOTP == $_SESSION['otp']) {
            echo "OTP verification successful! Welcome!";
            // Clear the OTP from the session
            unset($_SESSION['otp']);
            unset($_SESSION['otp_expiration']);
        } else {
            echo "Invalid OTP. Please try again.";
        }
    } else {
        echo "OTP is expired or does not exist. Please request a new one.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login Page</h2>
    
    <form method="post">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <input type="submit" name="verify_otp" value="Verify OTP">
    </form>
    
    <form method="post">
        <input type="submit" name="request_otp" value="Request OTP">
    </form>
</body>
</html>
