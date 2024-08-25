<?php
include "includes/dbconfig.php";
include "includes/functions.php";
include INCLUDES . "routes.php";

$urlPath = parseUrl($_SERVER['REQUEST_URI']);
$pageKey = $urlPath[0] ?? '';

if (array_key_exists($pageKey, $routes)) {
    $pageDetails = $routes[$pageKey];

    if ($pageKey === SINGLE_BLOG_SLUG) {
        $slug = $urlPath[1] ?? '';
        $pageDetails = !empty($slug) ? check_slug_and_load_blog($slug, $pageDetails) : $defaultRoute;
    } elseif ($pageKey === BLOGS_SLUG) {
        $pageNumber = isset($urlPath[2]) && $urlPath[1] === BLOGS_PAGE_SLUG ? (int)$urlPath[2] : 1;
        $pageDetails['title'] .= " - Page $pageNumber";
    }

    include INCLUDES . "public-layout.php";
} elseif ($pageKey === ADMIN_SLUG || $pageKey === API_SLUG) {
    $slug = $urlPath[1] ?? 'home';
    if ($pageKey === ADMIN_SLUG && array_key_exists($slug, $adminRoutes)) {
        session_start();
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            if ($slug !== "login") {
                header("location: /" . ADMIN_SLUG . "/login");
                exit; // Ensure the script stops here to prevent further execution
            } else {
                $page = $slug;
            }
        } else {
            if ($slug === "login") {
                header("location: /" . ADMIN_SLUG . "/home");
                exit; // Stop further script execution after the redirect
            } else {
                $page = $slug;
            }
        }

        $subPage = $urlPath[2] ?? '';
        $pageDetails = $adminRoutes[$page];
        include INCLUDES . "admin-layout.php";
    } elseif ($pageKey === API_SLUG && array_key_exists($slug, $apiRoutes)) {
        $endpoint = $slug;
        header("Content-Type: application/json");
        include API_ENDPOINTS . $apiRoutes[$slug];
    } else {
        header("Location: /404");
    }
} else {
    // Default to 404 if no matching route is found
    $pageDetails = $defaultRoute;
    include INCLUDES . "public-layout.php";
}
