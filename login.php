<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require "config/connect.php";

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $_POST["email"]);
    $stmt->execute();

    $result= $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $user["activation_token_hash"] === null) {
        if (password_verify($_POST["password"], $user["password_hash"])){
          session_start();
          session_regenerate_id();
          $_SESSION["user_id"] = $user["id"];
          header("Location: index.php");
          exit;
        }
    }
    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Login</h1>

    <?php if ($is_invalid): ?>
      <em>Invalid login, check your email if account is not activated.</em>
    <?php endif; ?>

    <form method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" <?= htmlspecialchars($_POST["email"] ?? "")?>  required>
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <button>Log in</button>
    <div>
    <a href="signup.php">Sign Up</a>
    </div>
    <div>
    <a href="forgot_password.php">Forgot Password</a>
    </div>
    </form>
</body>
</html>