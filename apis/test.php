<?php

// Function to generate random string for names and messages
function generateRandomString($length = 10)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Function to generate random email addresses
function generateRandomEmail()
{
    $domains = ['example.com', 'test.com', 'email.com'];
    return generateRandomString(5) . '@' . $domains[array_rand($domains)];
}

// Function to generate random phone numbers
function generateRandomPhone()
{
    return '123-456-' . rand(1000, 9999);
}

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO contactform_data (name, email, phone, message, submitted_at) VALUES (?, ?, ?, ?, ?)");
if ($stmt === false) {
    die('Failed to prepare SQL statement.');
}

// Bind parameters
$stmt->bind_param("sssss", $name, $email, $phone, $message, $submitted_at);

// Loop to generate and insert 50 random records
for ($i = 0; $i < 50; $i++) {
    $name = generateRandomString(rand(5, 10));
    $email = generateRandomEmail();
    $phone = generateRandomPhone();
    $message = generateRandomString(rand(20, 100));
    $submitted_at = date('Y-m-d H:i:s', strtotime('-' . rand(1, 365) . ' days')); // Random date in the past year

    // Execute the insert query
    if (!$stmt->execute()) {
        echo "Error inserting record: " . $stmt->error . "<br>";
    } else {
        echo "Record inserted successfully<br>";
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();

echo "50 records inserted successfully.";
