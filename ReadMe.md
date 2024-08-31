# Indian Wedding Photography Studio Website

Welcome to the Indian Wedding Photography Studio website project. This project provides a comprehensive online presence for a wedding photography studio, including a homepage, blog, and an admin dashboard for management.

## Project Overview

The website serves as a portfolio and service showcase for the studio, featuring:

- **Homepage**: Describes the studio's offerings, including wedding photography services and contact information.
- **Blog**: A section for posting updates, tips, and stories related to wedding photography.
- **Admin Dashboard**: A backend interface for managing content, including images, blog posts, and other data.

## Folder Structure

Here is a brief overview of the folder structure:

- `admin/` - Contains PHP files for admin pages FrontEnd Functionality.
  - `apis/` - API-related PHP files for handling data operations.
  - `assets/` - Contains CSS, JS, and image assets.
    - `css/` - Stylesheets for the website.
    - `images/` - Image assets used in the site.
    - `js/` - JavaScript files for site functionality.
  - `includes/` - Common PHP files used throughout the site.
    - `admin-layout.php` - Layout for the admin dashboard.
    - `dbconfig.php` - Database configuration.
    - `footer.php` - Footer layout for the site.
    - `functions.php` - Utility functions used across the site.
    - `header.php` - Header layout for the site.
    - `public-layout.php` - Layout for public-facing pages.
    - `routes.php` - All Website Routes Defined in this file along with their Page Title, Meta Description
  - `public/` - Public-facing PHP files for the website.
    - `404.php` - Page not found error page.
    - `home.php` - Homepage of the site.
    - `pricing-plans.php` - Pricing plans page.
    - `single-blog.php` - Single blog post page.
    - `terms-and-policies.php` - Terms and policies page.
    - `get-a-quote.php` - Page for requesting a quote.
    - `blogs.php` - Blog list page.
  - `browserconfig.xml` - Browser configuration file for Favicons.
- `.gitignore` - Specifies files and directories to ignore in version control just for developement.
- `.htaccess` - Configuration file for Apache web server.

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/hassancoder1/jvnsathistdio-re-built
   ```

2. **Navigate to the project directory:**

Navigate to project directory copy all files from there and paste whole files/code into Root folder of your server. then, open "dbconfig.php" from "includes" folder

Edit includes/dbconfig.php to include your database credentials.

Now just open your server/website in browser and access setup.php file
visit /setup.php in browser Follow if DB connection is ok then just click start Setup

Ensure that you have PHP and a web server (like Apache) installed.
Install any required PHP packages via Composer (if you use Composer).
Start the web server:

3. **Usage**

Access the Admin Dashboard:

Navigate to /secret-portal/login to log in to the admin dashboard.
default admin URL /secret-portal/
UserName: admin
Password: admin

You can change Admin Url by visiting includes/functions.php and change value in
define("ADMIN_SLUG", "secret-portal");

View the Website:<br>
Open your server/website in your web browser to view the website.

Contributing<br>
If you wish to contribute to this project, please follow these guidelines:

License:<br>
This project is licensed under the MIT License. See the LICENSE file for more details.

Contact:<br>
For any questions or support, please contact

- WhatsApp: https://wa.me/+923113549528<br>
- Instagram: @hassancoder<br>
- Linkedin: @hassancoder

Thank you for using the Indian Wedding Photography Studio website project. We hope it meets your needs for showcasing wedding photography services and managing content efficiently.
