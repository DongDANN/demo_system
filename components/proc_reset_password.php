<?php

$otp = $_POST["otp"];

$mysqli = require "../config/connect.php";

$stmt = $mysqli->prepare("SELECT * FROM users WHERE otp = ?");
$stmt->bind_param("s", $otp);

$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->free_result();
$mysqli->next_result();

if ($user === null) {
    die("wrong otp");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("UPDATE users SET password_hash = ?, otp = NULL WHERE id = ?");
$stmt->bind_param("ss", $password_hash, $user["id"]);

$stmt->execute();

header("Location: ../login.php");
exit();