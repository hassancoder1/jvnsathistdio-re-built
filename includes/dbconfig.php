<?php
// Define Database Credentials for Live Site 
// $server = "fdb1029.awardspace.net";
// $username = "3742499_jvnstudio";
// $password = "Hass1234an";
// $database = "3742499_jvnstudio";

// For LocalHost development
$server = "localhost";
$username = "root";
$password = "";
$database = "jvnstudio_new";

// Function to render error screen
function renderErrorScreen($errorMessage)
{
  echo "
     <script src='https://cdn.tailwindcss.com'></script>
    <div class='flex items-center justify-center min-h-screen bg-gradient-to-r from-indigo-500 to-blue-500'>
  <div class='max-w-md md:max-w-lg lg:max-w-xl px-8 py-12 rounded-lg shadow-lg bg-white'>
    <h1 class='text-4xl md:text-5xl lg:text-6xl font-bold text-center mb-6 text-indigo-800'>Database<br> Connection Error!</h1>
    <p class='text-lg md:text-xl lg:text-2xl text-gray-700 text-center mb-8'>
      {$errorMessage}
    </p>
    <p class='text-base md:text-lg lg:text-xl text-gray-600 text-center mb-8'>
      Please provide the correct login credentials in the
      <code class='inline-block bg-gray-200 px-2 py-1 rounded'>includes/dbconfig.php</code>
      file. Then click on start setup to create default data.
    </p>
    <div class='flex justify-center'>
      <a href='/setup.php' class='px-6 py-2 rounded-lg text-white font-bold bg-indigo-600 hover:bg-indigo-700 transition duration-300 ease-in-out'>
        Start Setup
      </a>
    </div>
  </div>
</div>";
  exit; // Prevent further script execution
}

// Check if current page is setup.php
$currentFile = basename($_SERVER['PHP_SELF']);

if ($currentFile !== 'setup.php') {
  try {
    // Attempt database connection
    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn) {
      throw new Exception("Unable to establish a database connection.");
    } else {
      // Connection successful, but might still need setup
      // Check if the necessary tables exist
      $requiredTables = ['admin', 'contactform_data', 'categories', 'getquoteform_data', 'images'];
      foreach ($requiredTables as $table) {
        $tableExistsQuery = "SHOW TABLES LIKE '{$table}'";
        $result = mysqli_query($conn, $tableExistsQuery);
        if (mysqli_num_rows($result) == 0) {
          throw new Exception("Required table '{$table}' does not exist.");
        }
      }

      // Check if default data exists in `admin` table
      $defaultDataChecks = [
        'login' => "SELECT * FROM admin WHERE specific_key = 'login'",
        'colortheme' => "SELECT * FROM admin WHERE specific_key = 'colortheme'"
      ];

      foreach ($defaultDataChecks as $key => $query) {
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
          throw new Exception("Default '{$key}' data is missing.");
        }
      }
    }
  } catch (Exception $e) {
    renderErrorScreen($e->getMessage());
  }
}
