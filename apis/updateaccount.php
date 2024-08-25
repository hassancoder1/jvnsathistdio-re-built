<?php
session_start();
$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
$encrypted_json = encryptData(json_encode([
    'username' => $username,
    'password' => $_POST['password']
]));
$sql = "UPDATE admin SET value = ? WHERE specific_key = ?";
$stmt = $conn->prepare($sql);
$specificKey = "login";
$stmt->bind_param("ss", $encrypted_json, $specificKey);
if ($stmt->execute()) {
    $_SESSION['username'] = $username;

    returnJSON('success', "Account Updated Successfully!");
} else {
    returnJSON('failed', "Update Not Successful!");
}
