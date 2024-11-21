<?php
session_start();
if(isset($_SESSION['user_id'])){
    $mysqli = require "config/connect.php";

    $stmt= $mysqli->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Demo</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="module" src="js/index.js"></script>
</head>
<body>
    <h1>API Demo - Geolocation</h1>
    <?php if (isset($_SESSION["user_id"])): ?>
            <p>Hello <?= htmlspecialchars($user["name"])?></p>
            <p><a href="components/proc_logout.php">Log out</a></p>
    <?php else: ?>
        <p><a href="login.php">Log in</a> or <a href="signup.php">sign up</a></p>
    <?php endif; ?>

    <div id="map"></div>

    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8ps9u4llkxJ9vymRLuIFHt0t-Z8eF76U&callback=initMap&v=weekly"
    defer
    ></script>
</body>
</html>