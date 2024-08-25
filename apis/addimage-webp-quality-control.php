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
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($imageExtension, $allowedExtensions)) {
            returnJSON('error', 'Invalid image file type. Only JPG, PNG, GIF, and WebP are allowed.');
            exit;
        }

        // Create a unique file name for the WebP file
        $uploadDir = ASSETS . "images/" . UPLOADS;
        $newImageName = uniqid('img_', true) . '.webp'; // Use .webp extension
        $uploadFilePath = $uploadDir . $newImageName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
        }

        // Convert the image to WebP format
        $imageResource = null;
        switch ($imageExtension) {
            case 'jpg':
            case 'jpeg':
                $imageResource = imagecreatefromjpeg($imageTmpPath);
                break;
            case 'png':
                $imageResource = imagecreatefrompng($imageTmpPath);
                break;
            case 'gif':
                $imageResource = imagecreatefromgif($imageTmpPath);
                break;
            case 'webp':
                $imageResource = imagecreatefromwebp($imageTmpPath); // If it's already webp, we just load it
                break;
        }

        if ($imageResource && imagewebp($imageResource, $uploadFilePath, 10)) {
            imagedestroy($imageResource); // Free up memory

            // Prepare and insert the image details into the database
            $stmt = $conn->prepare("INSERT INTO images (name, location, category, image_path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $location, $category, $newImageName);

            if ($stmt->execute()) {
                returnJSON('success', 'Image uploaded and converted to WebP successfully.');
            } else {
                returnJSON('error', 'Database error: Could not save image details.');
            }
            $stmt->close();
        } else {
            returnJSON('error', 'Failed to convert image to WebP format.');
        }
    } else {
        returnJSON('error', 'Please select an image to upload.');
    }
}
