<?php
// Check if the usehexvalue checkbox is checked
$useHexValues = isset($_POST['usehexvalue']) && $_POST['usehexvalue'] === 'on';

// Fetch the appropriate values based on the checkbox state
$bgPrimary = $bgSecondary = $textPrimary = $textSecondary = $primary = $secondary = ''; // Default values

if ($useHexValues) {
    // Use text field values
    $bgPrimary = isset($_POST['bgprimarytextfield']) ? $_POST['bgprimarytextfield'] : '';
    $bgSecondary = isset($_POST['bgsecondarytextfield']) ? $_POST['bgsecondarytextfield'] : '';
    $textPrimary = isset($_POST['textprimarytextfield']) ? $_POST['textprimarytextfield'] : '';
    $textSecondary = isset($_POST['textsecondarytextfield']) ? $_POST['textsecondarytextfield'] : '';
    $primary = isset($_POST['primarytextfield']) ? $_POST['primarytextfield'] : '';
    $secondary = isset($_POST['secondarytextfield']) ? $_POST['secondarytextfield'] : '';
} else {
    // Use color field values
    $bgPrimary = isset($_POST['bgprimarycolorfield']) ? $_POST['bgprimarycolorfield'] : '';
    $bgSecondary = isset($_POST['bgsecondarycolorfield']) ? $_POST['bgsecondarycolorfield'] : '';
    $textPrimary = isset($_POST['textprimarycolorfield']) ? $_POST['textprimarycolorfield'] : '';
    $textSecondary = isset($_POST['textsecondarycolorfield']) ? $_POST['textsecondarycolorfield'] : '';
    $primary = isset($_POST['primarycolorfield']) ? $_POST['primarycolorfield'] : '';
    $secondary = isset($_POST['secondarycolorfield']) ? $_POST['secondarycolorfield'] : '';
}

// Encrypt the JSON data for color theme
$encrypted_json = encryptData(json_encode([
    'bgPrimary' => $bgPrimary,
    'bgSecondary' => $bgSecondary,
    'textPrimary' => $textPrimary,
    'textSecondary' => $textSecondary,
    'primary' => $primary,
    'secondary' => $secondary,
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
