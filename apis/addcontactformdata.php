<?php
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');


$encrypted_email = encryptData($email);
$encrypted_phone = encryptData($phone);

$sql_insert_contact = "INSERT INTO contactform_data (name, email, phone, message) VALUES (?, ?, ?, ?)";
$stmt_contact = $conn->prepare($sql_insert_contact);
$stmt_contact->bind_param("ssss", $name, $encrypted_email, $encrypted_phone, $message);
if ($stmt_contact->execute()) {
    returnJSON('success', "Form Submitted Successfully!");
} else {
    returnJSON('failed', "There was an error submitting the form.");
}
$stmt_contact->close();
$conn->close();
