<?php
if (isset($_GET['id']) && isset($_GET['table'])) {
    $id = decryptData($_GET['id']);
    $table = decryptData($_GET['table']);

    $sql = "DELETE FROM $table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            if (isset($_GET['delimg'])) {
                $path = ASSETS . "images/" . UPLOADS;
                $imgname = decryptData($_GET['delimg']);
                unlink($path . $imgname);
            }
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
    // Redirect to 404 if something fails
    header("Location: /404");
    exit;
} else {
    // Redirect to 404 if parameters are missing
    header("Location: /404");
    exit;
}
