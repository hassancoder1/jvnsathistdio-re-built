<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $location = isset($_POST['location']) ? htmlspecialchars(trim($_POST['location'])) : '';
    $category = isset($_POST['category']) ? htmlspecialchars(trim($_POST['category'])) : '';

    // Check required fields
    if (empty($name) || empty($location)) {
        returnJSON('error', 'Please provide all required fields.');
        exit;
    }

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Allowed file extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', "webp"];

        if (!in_array($imageExtension, $allowedExtensions)) {
            returnJSON('error', 'Invalid image file type. Only JPG, PNG, and GIF are allowed.');
            exit;
        }

        // Create a unique file name and set the upload path
        $uploadDir = ASSETS . "images/" . UPLOADS;
        $newImageName = uniqid('img_', true) . '.' . $imageExtension;
        $uploadFilePath = $uploadDir . $newImageName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
        }

        if (move_uploaded_file($imageTmpPath, $uploadFilePath)) {
            // Prepare and insert the image details into the database
            $stmt = $conn->prepare("INSERT INTO images (name, location, category, image_path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $location, $category, $newImageName);

            if ($stmt->execute()) {
                returnJSON('success', 'Image uploaded successfully.');
            } else {
                returnJSON('error', 'Database error: Could not save image details.');
            }
            $stmt->close();
        } else {
            returnJSON('error', 'Failed to move uploaded image.');
        }
    } else {
        returnJSON('error', 'Please select an image to upload.');
    }
}
