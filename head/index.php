<?php
// Retrieve the requested page from the URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Define the path to the requested page
$page_path = __DIR__ . "/$page.php";

// Check if the requested page exists
if (file_exists($page_path)) {
  // Include the requested page
  include($page_path);
} else {
  // Display an error message or redirect to a 404 page
  echo "Page not found";
}
?>