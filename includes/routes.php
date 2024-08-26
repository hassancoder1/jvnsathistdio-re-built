<?php
// Define known paths and their corresponding metadata for frontend
$routes = [
    '' => [
        'file' => 'home.php',
        'title' => 'Welcome to homepage',
        'description' => 'This is the landing page',
    ],
    'get-a-quote' => [
        'file' => 'get-a-quote.php',
        'title' => 'Get Quote Form',
        'description' => 'This is the Get Quote Form page',
    ],
    'test' => [
        'file' => 'test.php',
        'title' => 'Test Page',
        'description' => 'This is a test page',
    ],
    'terms-and-policies' => [
        'file' => 'terms-and-policies.php',
        'title' => 'Our Terms & Policies',
        'description' => 'This is our Terms & Policies Page',
    ],
    'blogs' => [
        'file' => 'blogs.php',
        'title' => 'Blogs List Page',
        'description' => 'List of all blogs',
    ],
    'blog' => [
        'file' => 'single-blog.php',
        'title' => '',
        'description' => '',
        'blog_content' => '',
    ],
];

$adminRoutes = [
    'login' => [
        'file' => 'login.php',
        'title' => 'Login to Admin Dashboard',
        'description' => 'Login to Admin Dashboard',
    ],
    'home' => [
        'file' => 'home.php',
        'title' => 'Admin Dashboard',
        'description' => 'This is the admin dashboard',
        'label' => 'Dashboard',
        'icon' => 'fa-home'
    ],
    'addnewimage' => [
        'file' => 'add-new-image.php',
        'title' => 'Add New Images',
        'description' => 'Images',
        'label' => 'Add Images',
        'icon' => 'fa-plus'
    ],
    'hero-slider' => [
        'file' => 'hero-slider.php',
        'title' => 'Manage Hero Slider Images',
        'description' => 'Manage Hero Slider Images',
        'label' => 'Hero Slider',
        'icon' => 'fa-sliders-h'
    ],
    'photoshoot' => [
        'file' => 'photoshoot.php',
        'title' => 'Manage PhotoShoot Images',
        'description' => 'Manage PhotoShoot Images',
        'label' => 'PhotoShoot',
        'icon' => 'fa-camera'
    ],
    'gallery' => [
        'file' => 'gallery.php',
        'title' => 'Manage Gallery Images',
        'description' => 'Manage Gallery Images',
        'label' => 'Gallery',
        'icon' => 'fa-images'
    ],
    'blogpost' => [
        'file' => 'blogpost.php',
        'title' => 'Add/Edit Blog Post',
        'description' => 'Manage Blog Post',
        'label' => 'Manage Blog Post',
        'icon' => 'fa-tasks'
    ],
    'blogs' => [
        'file' => 'blogs.php',
        'title' => 'Manage Blog Posts',
        'description' => 'Manage Blog Posts',
        'label' => 'Blogs',
        'icon' => 'fa-blog'
    ],
    'contact-form' => [
        'file' => 'contact-form-data.php',
        'title' => 'Contact Form Data',
        'description' => 'Contact Form Data Filled by Users.',
        'label' => 'Contact Form Data',
        'icon' => 'fa-envelope'
    ],
    'getquote-form' => [
        'file' => 'getquote-form-data.php',
        'title' => 'Get Quote Form Data',
        'description' => 'Get Quote Form Data Filled by Users.',
        'label' => 'Get Quote Form Data',
        'icon' => 'fa-file-alt'
    ],
    'settings' => [
        'file' => 'settings.php',
        'title' => 'Settings',
        'description' => 'This is the admin settings page',
        'label' => 'Settings',
        'icon' => 'fa-cog'
    ],
    // Add more routes as needed
];


$apiRoutes = [
    "fetchtheme" => "fetchtheme.php",
    "loginform" => "handlelogin.php",
    "logout" => "logout.php",
    "updateaccount" => "updateaccount.php",
    "contactform" => "addcontactformdata.php",
    "getquoteform" => "addgetquoteformdata.php",
    "addcategory" => "addcategory.php",
    "deleterecord" => "deleterecord.php",
    "deleteblogpost" => "deleteblogpost.php",
    "addimage" => "addimage.php",
    "blogpost" => "blogpost.php",
    "updateviewscount" => "updateviewscount.php",
    "updatetheme" => "updatetheme.php",
    "settings" => "settings.php",
];

// Default 404 route
$defaultRoute = [
    'file' => '404.php',
    'title' => '404 Not Found',
    'description' => 'Page not found',
];

function check_slug_and_load_blog($slug, $pageDetails)
{
    // ### This function is Not abandond but used a bit. But whole single blog functionality relays on this function. To complete this function you'll have to change many things. So leave it as it's working.
    $found = true; // Replace with actual check from the database

    if ($found) {
        $pageDetails['title'] = "Sample Blog Title for $slug";
        $pageDetails['description'] = "This is the description for the blog with slug $slug.";
        $pageDetails['blog_content'] = "This is the content of the blog post => $slug";
    } else {
        $pageDetails = [
            'file' => '404.php',
            'title' => '404 Not Found',
            'description' => 'Page not found',
        ];
    }

    return $pageDetails;
}
