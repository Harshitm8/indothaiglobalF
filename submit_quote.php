<?php
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$host = 'localhost';
$db   = 'enquiries';
$user = 'enquiry';
$pass = 'Enquiry2024';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

$name    = $conn->real_escape_string($_POST['name'] ?? '');
$email   = $conn->real_escape_string($_POST['email'] ?? '');
$phone   = $conn->real_escape_string($_POST['phone'] ?? '');
$country = $conn->real_escape_string($_POST['country'] ?? '');
$product = $conn->real_escape_string($_POST['product'] ?? '');
$message = $conn->real_escape_string($_POST['message'] ?? '');

$sql = "INSERT INTO enquiries (name, email, phone, country, product, message)
        VALUES ('$name','$email','$phone','$country','$product','$message')";

if ($conn->query($sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Query failed: ' . $conn->error]);
    $conn->close();
    exit;
}

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtpout.secureserver.net';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@indothaiglobal.com';
    $mail->Password   = 'Indothaiglobal@1983';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    $mail->setFrom('info@indothaiglobal.com', 'Indo Thai Global');
    $mail->addAddress('info@indothaiglobal.com');
    $mail->Subject = 'New Enquiry from ' . $name;
    $mail->Body    = "Name: $name\nEmail: $email\nPhone: $country $phone\nMessage: $message";

    $mail->send();
} catch (Exception $e) {
    // mail failed silently — DB save already succeeded
}

$conn->close();
?>