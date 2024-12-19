<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

$mail = new PHPMailer(true);

 $mysqli = require "../config/connect.php";

 $activation_token = bin2hex(random_bytes(16));
 $activation_token_hash = hash("sha256", $activation_token);

 $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

 $stmt= $mysqli->prepare("INSERT INTO users (email, phone, name, password_hash, activation_token_hash) VALUES (?, ?, ?, ?, ?)");
 $stmt->bind_param("sssss", $_POST["email"], $_POST["phone"], $_POST["name"], $password_hash,  $activation_token_hash);

 try {
    $stmt->execute();
    $mail->isHTML(true);                                  //Set email format to HTML;
    
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'r.sullano2003@gmail.com';                     //SMTP username
    $mail->Password   = 'xxxx xxxx xxxx xxxx';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;

    $mail->setFrom('r.sullano2003@gmail.com', 'Activate Account');
    $mail->addAddress($_POST["email"]);
    $mail->addReplyTo('no-reply@gmail.com', 'No Reply');
    $mail->Subject = 'Verification';
    $mail->Body    = <<<END
        Click <a href="http://localhost/demo_system/components/proc_activate_account.php?token=$activation_token_hash">here</a> to activate account.
    END;

    $mail->send();
    header("Location: ../login.php");
    exit;
} catch (mysqli_sql_exception $e) {
    die($e->getMessage());
}
