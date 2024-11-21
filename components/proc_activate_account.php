<?php
$token = $_GET["token"];

$mysqli = require "../config/connect.php";

$stmt = $mysqli->prepare("SELECT * FROM users WHERE activation_token_hash = ?");
$stmt->bind_param("s", $token);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("Token not found. Debug info: " . htmlspecialchars($token));
}

$stmt->free_result();
$mysqli->next_result();

$stmt = $mysqli->prepare("UPDATE users SET activation_token_hash = NULL, activation_token_hash = NULL WHERE id = ?");
$stmt->bind_param("i", $user["id"]);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activated</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Account Activated</h1>  
    <p>Account activated. You can now <a href="../login.php">login</a></p>
</body>
</html>