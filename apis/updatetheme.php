<?php
// Encrypt the JSON data for color theme
$encrypted_json = encryptData(json_encode([
    'bgPrimary' => $_POST['bgprimary'],
    'bgSecondary' => $_POST['bgsecondary'],
    'textPrimary' => $_POST['textprimary'],
    'textSecondary' => $_POST['textsecondary'],
    'primary' => $_POST['primary'],
    'secondary' => $_POST['secondary'],
]));

// Prepare and execute the update query
$sql = "UPDATE admin SET value = ? WHERE specific_key = ?";
$stmt = $conn->prepare($sql);
$specificKey = "colortheme";
$stmt->bind_param("ss", $encrypted_json, $specificKey);

if ($stmt->execute()) {
    // Send success response
    returnJSON('success', "Color Theme Updated Successfully!", "/" . ADMIN_SLUG . "/settings");
} else {
    // Send failure response
    returnJSON('failed', "Theme Update Error!");
}
