<?php
session_start(); // Ensure session is started at the top

$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
$remember_user = isset($_POST['rememberme']) && $_POST['rememberme'] === '1';

if ($remember_user) {
    setcookie(session_name(), session_id(), time() + 604800); // 7 days
}

$encrypted_json = encryptData(json_encode([
    'username' => $username,
    'password' => $_POST['password']
]));

// Fetch the stored value from the database
$sql = "SELECT value FROM admin WHERE specific_key = ?";
$stmt = $conn->prepare($sql);
$specificKey = "login";
$stmt->bind_param("s", $specificKey);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Compare encrypted JSON with the stored value
    if ($encrypted_json === $row['value']) {
        // Set session variables after successful login
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;

        // Send the success response with redirect
        returnJSON('success', "Login Successful!", "/" . ADMIN_SLUG . "/home");
    } else {
        // Send failure response if login fails
        returnJSON('failed', "Login Credentials Wrong!");
        session_destroy();
    }
} else {
    // Handle case where no matching record is found
    returnJSON('failed', "Invalid Login Credentials!");
}
