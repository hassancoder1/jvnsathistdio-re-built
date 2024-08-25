<?php
if (isset($_GET['id'])) {
    $id = decryptData($_GET['id']);
    $table = "posts";

    try {
        // Fetch the blog post details
        $sql = "SELECT image, content FROM $table WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new mysqli_sql_exception('Failed to prepare SQL statement.');
        }
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            throw new mysqli_sql_exception('Failed to execute SQL statement.');
        }
        $result = $stmt->get_result();
        $post = $result->fetch_assoc();
        $stmt->close();

        if (!$post) {
            throw new Exception('Post not found.');
        }

        // Delete the featured image if exists
        $uploadDir = ASSETS . "images/" . UPLOADS . "/";
        if ($post['image']) {
            $featuredImagePath = $uploadDir . $post['image'];
            if (file_exists($featuredImagePath)) {
                unlink($featuredImagePath);
            }
        }

        // Extract image URLs from the content
        $imageUrls = extractImageUrls($post['content']);

        // Delete the images from the content
        foreach ($imageUrls as $imageUrl) {
            $imageFilePath = str_replace(ROOT_URL . ASSETS . "images/" . UPLOADS . "/", $uploadDir, $imageUrl);
            if (file_exists($imageFilePath)) {
                unlink($imageFilePath);
            }
        }

        // Delete the post record from the database
        $sql = "DELETE FROM $table WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new mysqli_sql_exception('Failed to prepare SQL statement.');
        }
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            throw new mysqli_sql_exception('Failed to execute SQL statement.');
        }
        $stmt->close();

        // Redirect back with success
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } catch (Exception $e) {
        // Handle errors and redirect to 404
        error_log('Error deleting blog post: ' . $e->getMessage());
        header("Location: /404");
        exit;
    }
} else {
    // Redirect to 404 if parameters are missing
    header("Location: /404");
    exit;
}

// Function to extract image URLs from the content
function extractImageUrls($content)
{
    $pattern = '/<img\s+src="([^"]+)"/i';
    preg_match_all($pattern, $content, $matches);
    return $matches[1]; // Return the array of image URLs
}
