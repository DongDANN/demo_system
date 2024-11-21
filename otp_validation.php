<?php
$mysqli = require "config/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE otp = ?");
    $stmt->bind_param("s", $_POST['otp']);

    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user === null) {
        die("wrong OTP");
    }else {
        header("Location: password_reset.php?otp=" . $_POST['otp']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
<h1>OTP Verification</h1>

<form action="" method="post" id="reset">
    <label for="otp">Enter OTP sent to your mobile</label>
    <input type="text" name="otp" id="otp">
    <button type="submit">Submit</button>
</form>
</body>
</html>
