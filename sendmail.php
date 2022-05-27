<?php
session_start();

$mailAdress = $_POST['email'];
$subject = "Historiques de vos conversions";
$message = implode("\n", $_SESSION['history']);

// TODO : configurer headers + SMTP
//mail($mailAdress, $subject, $message);

header('Location: /');