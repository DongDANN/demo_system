<?php
require_once '../vendor/autoload.php';
$mysqli = require "../config/connect.php";

$phone = $_POST['phone'];
$otp = random_int(100000, 999999);
$message = "Your OTP is:" . $otp;

$stmt = $mysqli->prepare("UPDATE users SET otp = ? WHERE phone = ?");
$stmt->bind_param("ss", $otp, $phone);
$stmt->execute();
$stmt->close();

$sid = "AC22607596a64770b6c247b0d38d6e7c46";
$sid = "";
$token = "";
$client = new Twilio\Rest\Client($sid, $token);

// Use the Client to make requests to the Twilio REST API
$client->messages->create(
    // The number you'd like to send the message to
    $phone,
    [
        // A Twilio phone number you purchased at https://console.twilio.com
        'from' => '+16468467239',
        // The body of the text message you'd like to send
        'body' => $message
    ]
);
header("Location: ../otp_validation.php");
exit();
