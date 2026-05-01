<?php
header('Content-Type: application/json');

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
}

$to      = 'info@indothaiglobal.com';
$subject = 'New Enquiry from ' . $name;
$body    = "Name: $name\nEmail: $email\nPhone: $country $phone\nMessage: $message";
$headers = 'From: noreply@indothaiglobal.com';

mail($to, $subject, $body, $headers);
$conn->close();
?>