<?php
define('ENCRYPTION_KEY', '4a7d1ed414474e4033ac29ccb8653d9d476af3b89f7bfb6e89ef54b3e94d1dcb');
define('ENCRYPTION_IV', '9f86d081884c7d659a2feaa0c55ad015');
include "includes/dbconfig.php";

// Attempt to connect to the database
$conn = mysqli_connect($server, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

function encryptData($data)
{
    $key = hash('sha256', ENCRYPTION_KEY, true);
    $iv = substr(hash('sha256', ENCRYPTION_IV), 0, 16);
    $encryptedData = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
    return base64_encode($encryptedData);
}

// Create tables in a batch and suppress errors if they already exist
$table_queries = [
    "CREATE TABLE IF NOT EXISTS admin (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        specific_key VARCHAR(255) NOT NULL UNIQUE,
        value TEXT NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS contactform_data (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS posts (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        slug VARCHAR(255) NOT NULL,
        image VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS categories (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL UNIQUE
    )",
    "CREATE TABLE IF NOT EXISTS getquoteform_data (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        phone VARCHAR(255) NOT NULL,
        service VARCHAR(255) NOT NULL,
        event_start_time DATETIME NOT NULL,
        event_end_time DATETIME NOT NULL,
        event_location TEXT NOT NULL,
        plan VARCHAR(255),
        details TEXT NOT NULL,
        submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS images (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        location VARCHAR(255) NOT NULL,
        category VARCHAR(255),
        image_path VARCHAR(255) NOT NULL,
        uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )"
];

foreach ($table_queries as $query) {
    $conn->query($query);
}

// Prepare encrypted data for default admin records
$encrypted_json_colortheme = encryptData(json_encode([
    'bgPrimary' => "#ffffff",
    'bgSecondary' => "#e5e7eb",
    'textPrimary' => "#0f172a",
    'textSecondary' => "#6B728F",
    'primary' => "#ff5c61",
    'secondary' => "#ffb300"
]));

$encrypted_json_login = encryptData(json_encode([
    'username' => "admin",
    'password' => "admin"
]));

// Insert default data into the admin table, ignore errors for existing records
$default_admin_values = [
    ['colortheme', $encrypted_json_colortheme],
    ['login', $encrypted_json_login],
    ['viewcount', 0]
];

$stmt_admin = $conn->prepare("INSERT IGNORE INTO admin (specific_key, value) VALUES (?, ?)");
foreach ($default_admin_values as $value) {
    $stmt_admin->bind_param("ss", $value[0], $value[1]);
    $stmt_admin->execute();
}

// Insert default categories using a single query
$default_categories = ['groom', 'bride', 'couple'];
$categories_placeholders = implode(',', array_fill(0, count($default_categories), '(?)'));

$sql_insert_categories = "INSERT IGNORE INTO categories (name) VALUES " . $categories_placeholders;
$stmt_categories = $conn->prepare($sql_insert_categories);
$stmt_categories->bind_param(str_repeat("s", count($default_categories)), ...$default_categories);
$stmt_categories->execute();

// Close the connection
$conn->close();

// Optionally, delete the setup script after setup
if (file_exists(__FILE__)) {
    unlink(__FILE__);
}

// Redirect to homepage after setup
header("Location: /");
exit;
