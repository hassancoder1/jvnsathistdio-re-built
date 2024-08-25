<?php
// Get and sanitize the input data
$category_name = htmlspecialchars($_POST['category_name'], ENT_QUOTES, 'UTF-8');

// Prepare the SQL query to insert the new category
$sql_insert_category = "INSERT INTO categories (name) VALUES (?)";
$stmt_category = $conn->prepare($sql_insert_category);
$stmt_category->bind_param("s", $category_name);

if ($stmt_category->execute()) {
    returnJSON('success', "Category added successfully!", "/" . ADMIN_SLUG . "/settings");
} else {
    returnJSON('failed', "There was an error adding the category.");
}

$stmt_category->close();
$conn->close();
