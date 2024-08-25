<?php
define('ROOT_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/');
define('ENCRYPTION_KEY', '4a7d1ed414474e4033ac29ccb8653d9d476af3b89f7bfb6e89ef54b3e94d1dcb');
define('ENCRYPTION_IV', '9f86d081884c7d659a2feaa0c55ad015');
define("INCLUDES", "includes/");
define("ASSETS", "assets/");
define("PUBLIC_PAGES", "public/");
define("ADMIN_PAGES", "admin/");
define("API_ENDPOINTS", "apis/");
define("ADMIN_SLUG", "secret-portal");
define("API_SLUG", "api");
define("BLOGS_SLUG", "blogs");
define("SINGLE_BLOG_SLUG", "blog");
define("BLOGS_PAGE_SLUG", "page");
define("UPLOADS", "uploads/");


function parseUrl($url)
{
    $parsedUrl = parse_url($url);
    $path = trim($parsedUrl['path'], '/');
    return explode('/', $path);
}
function set_color_scheme()
{
    global $conn;
    // Fetch the stored color scheme from the database
    $sql = "SELECT value FROM admin WHERE specific_key = ?";
    $stmt = $conn->prepare($sql);
    $specificKey = "colortheme";
    $stmt->bind_param("s", $specificKey);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $decryptedData = decryptData($row['value']);
        $colorScheme = json_decode($decryptedData, true);
    } else {
        $colorScheme = [
            'bgPrimary' => "#ffffff",
            'bgSecondary' => "#e5e7eb",
            'textPrimary' => "#0f172a",
            'textSecondary' => "#6B728F",
            'primary' => "#7c3aed",
            'secondary' => "#e11d48",
        ];
    }
    return $colorScheme;
}

// Example usage
$theme = set_color_scheme();

function getAsset($fileName, $subDir)
{
    return ROOT_URL . ASSETS . $subDir . $fileName;
}

function encryptData($data)
{
    $key = hash('sha256', ENCRYPTION_KEY, true);
    $iv = substr(hash('sha256', ENCRYPTION_IV), 0, 16);
    $encryptedData = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
    return base64_encode($encryptedData);
}
function decryptData($encryptedData)
{
    $key = hash('sha256', ENCRYPTION_KEY, true);
    $iv = substr(hash('sha256', ENCRYPTION_IV), 0, 16);
    $encryptedData = base64_decode($encryptedData);
    return openssl_decrypt($encryptedData, 'AES-256-CBC', $key, 0, $iv);
}

function returnJSON($type, $msg, $redirect = '')
{
    $json_array = array(
        "status" => $type,
        "msg" => $msg
    );
    if ($redirect != ''):
        $json_array["redirect"] = $redirect;
    endif;
    echo json_encode($json_array);
}
