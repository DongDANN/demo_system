<?php
$otp = $_GET["otp"];

$mysqli = require "config/connect.php";

$stmt = $mysqli->prepare("SELECT * FROM users WHERE otp = ?");
$stmt->bind_param("s", $otp);

$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("wrong otp");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
<h1>Reset Password</h1>

<form action="components/proc_reset_password.php" method="post" id="reset">
    <input type="hidden" name="otp" value="<?= htmlspecialchars($otp) ?>">
    <div>
    <label for="password">New Password</label>
    <input type="password" name="password" id="password">
    </div>
    <div>
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation">
    </div>
    <button>Reset Password</button>
</form>
</body>
</html>