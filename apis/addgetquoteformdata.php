<?php
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
$service = htmlspecialchars($_POST['service'], ENT_QUOTES, 'UTF-8');
$plan = isset($_POST['plan']) ? htmlspecialchars($_POST['plan'], ENT_QUOTES, 'UTF-8') : null;

if ($service === 'Other') {
    $service = isset($_POST['custom_service']) ? htmlspecialchars($_POST['custom_service'], ENT_QUOTES, 'UTF-8') : $service;
}

if ($plan === 'Custom') {
    $plan = isset($_POST['budget']) ? htmlspecialchars($_POST['budget'], ENT_QUOTES, 'UTF-8') : $plan;
}

$event_start_time = $_POST['eventstarttime'];
$event_end_time = $_POST['eventendtime'];
$event_location = htmlspecialchars($_POST['eventlocation'], ENT_QUOTES, 'UTF-8');
$details = htmlspecialchars($_POST['details'], ENT_QUOTES, 'UTF-8');

$encrypted_phone = encryptData($phone);
$encrypted_event_location = encryptData($event_location);

$sql_insert_quote = "INSERT INTO getquoteform_data (name, phone, service, event_start_time, event_end_time, event_location, plan, details) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt_quote = $conn->prepare($sql_insert_quote);
$stmt_quote->bind_param("ssssssss", $name, $encrypted_phone, $service, $event_start_time, $event_end_time, $encrypted_event_location, $plan, $details);
if ($stmt_quote->execute()) {
    returnJSON('success', "Got it! We'll Contact you very soon!");
} else {
    returnJSON('failed', "Failed to Submit!");
}

$stmt_quote->close();
$conn->close();
