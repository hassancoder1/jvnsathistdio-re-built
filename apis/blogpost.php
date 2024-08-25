<?php
$uploadDir = ASSETS . "images/" . UPLOADS . "/";

// Function to extract and move base64 images to the correct uploads folder
function processBase64Images($content)
{
    // Correct directory and URL paths
    $uploadDir = ASSETS . "images/" . UPLOADS . "/";
    $rootUrl = ROOT_URL . ASSETS . "images/" . UPLOADS . "/";

    $pattern = '/<img\s+src="(data:image\/(jpg|jpeg|png|gif|webp);base64,[^"]+)"/i';
    preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $base64Data = $match[1];
        $imageType = $match[2];

        // Decode the base64 data
        $imageData = base64_decode(str_replace('data:image/' . $imageType . ';base64,', '', $base64Data));

        // Generate a unique file name for content images
        $newImageName = uniqid('img_', true) . '.' . $imageType;
        $newImagePath = $uploadDir . $newImageName;

        // Ensure the directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Save the image to the correct uploads folder
        file_put_contents($newImagePath, $imageData);

        // Replace base64 data with the new image URL in the content
        $content = str_replace($base64Data, $rootUrl . $newImageName, $content);
    }

    return $content;
}

// Function to extract image URLs from the content
function extractImageUrls($content)
{
    $pattern = '/<img\s+src="([^"]+)"/i';
    preg_match_all($pattern, $content, $matches);

    return $matches[1]; // Return the array of image URLs
}

// Function to create a slug from a given string
function createSlug($title, $conn)
{
    // Convert title to a URL-friendly slug
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

    // Check if the slug already exists in the database
    $originalSlug = $slug;
    $count = 1;

    $sql = "SELECT COUNT(*) as count FROM posts WHERE slug = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        throw new mysqli_sql_exception('Failed to prepare SQL statement.');
    }

    while (true) {
        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // If slug exists, generate a new one by appending a number
        if ($row['count'] > 0) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        } else {
            break;
        }
    }

    return $slug;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $title = isset($_POST['title']) ? htmlspecialchars(trim($_POST['title'])) : '';
    $content = isset($_POST['content']) ? $_POST['content'] : ''; // Rich text content
    $postId = isset($_POST['postId']) ? (int)$_POST['postId'] : 0; // For editing existing posts

    // Check required fields
    if (empty($title) || empty($content)) {
        returnJSON('failed', 'Please provide all required fields.');
    }

    // Process only base64 images in content and leave URLs untouched
    $newContent = processBase64Images($content);

    try {
        if ($postId) {
            // Editing existing post
            $sql = "SELECT content, image, slug FROM posts WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                throw new mysqli_sql_exception('Failed to prepare SQL statement.');
            }
            $stmt->bind_param("i", $postId);
            if (!$stmt->execute()) {
                throw new mysqli_sql_exception('Failed to execute SQL statement.');
            }
            $result = $stmt->get_result();
            $post = $result->fetch_assoc();
            $oldContent = $post['content'];
            $oldImageName = $post['image'];
            $oldSlug = $post['slug']; // Slug remains unchanged on update
            $stmt->close();

            // Extract image URLs from old content and new content
            $oldImageUrls = extractImageUrls($oldContent);
            $newImageUrls = extractImageUrls($newContent);

            // Identify images that were removed
            $removedImages = array_diff($oldImageUrls, $newImageUrls);

            // Delete removed images from the uploads folder
            foreach ($removedImages as $imageUrl) {
                $imageFilePath = str_replace(ROOT_URL . ASSETS . "images/" . UPLOADS . "/", $uploadDir, $imageUrl);
                if (file_exists($imageFilePath)) {
                    unlink($imageFilePath);
                }
            }

            // Handle file upload if a featured image was sent
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imageTmpPath = $_FILES['image']['tmp_name'];
                $imageName = $_FILES['image']['name'];
                $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (!in_array($imageExtension, $allowedExtensions)) {
                    returnJSON('error', 'Invalid image file type. Only JPG, PNG, GIF, and WEBP are allowed.');
                }

                $newImageName = uniqid('featured_', true) . '.' . $imageExtension;
                $uploadFilePath = $uploadDir . $newImageName;

                // Ensure the directory exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Move the uploaded featured image to the uploads folder
                if (!move_uploaded_file($imageTmpPath, $uploadFilePath)) {
                    throw new mysqli_sql_exception('Failed to move uploaded image.');
                }

                // Delete the old featured image if it exists and is different
                if ($oldImageName && $oldImageName !== $newImageName) {
                    $oldImagePath = $uploadDir . $oldImageName;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $sql = "UPDATE posts SET title = ?, content = ?, image = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    throw new mysqli_sql_exception('Failed to prepare SQL statement.');
                }
                $stmt->bind_param("sssi", $title, $newContent, $newImageName, $postId);
            } else {
                // Update the post without changing the featured image
                $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    throw new mysqli_sql_exception('Failed to prepare SQL statement.');
                }
                $stmt->bind_param("ssi", $title, $newContent, $postId);
            }

            if ($stmt->execute()) {
                returnJSON('success', 'Blog post updated successfully.', '/' . ADMIN_SLUG . "/blogs");
            } else {
                throw new mysqli_sql_exception('Database error: Could not update blog post.');
            }
        } else {
            // Creating new post
            // Generate a slug for the new post
            $slug = createSlug($title, $conn);

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imageTmpPath = $_FILES['image']['tmp_name'];
                $imageName = $_FILES['image']['name'];
                $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (!in_array($imageExtension, $allowedExtensions)) {
                    returnJSON('error', 'Invalid image file type. Only JPG, PNG, GIF, and WEBP are allowed.');
                }

                $newImageName = uniqid('featured_', true) . '.' . $imageExtension;
                $uploadFilePath = $uploadDir . $newImageName;

                // Ensure the directory exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Move the uploaded featured image to the uploads folder
                if (!move_uploaded_file($imageTmpPath, $uploadFilePath)) {
                    throw new mysqli_sql_exception('Failed to move uploaded image.');
                }
            } else {
                $newImageName = ''; // No featured image uploaded
            }

            $sql = "INSERT INTO posts (title, slug, image, content) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                throw new mysqli_sql_exception('Failed to prepare SQL statement.');
            }
            $stmt->bind_param("ssss", $title, $slug, $newImageName, $newContent);

            if ($stmt->execute()) {
                returnJSON('success', 'Blog post created successfully.', "/" . ADMIN_SLUG . "/blogs");
            } else {
                throw new mysqli_sql_exception('Database error: Could not save blog post details.');
            }
        }
    } catch (mysqli_sql_exception $e) {
        returnJSON('failed', 'Database error: ' . $e->getMessage());
    }
}
