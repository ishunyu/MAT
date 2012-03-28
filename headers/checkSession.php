<?php
require_once "databaseConfig.php";

// Starts/resumes our session
session_start();

// If there's not accountName variables, then user is not logged on
if(!isset($_SESSION['username'])) {
  session_unset();
  
  // Equivalent to logout, clears all sessions
  session_destroy();
  
  // Redirect to main page
  $redirectPath =
    ($_SERVER["HTTP_HOST"] == "localhost") ?
    "location:https://localhost/MAT/index.php" : "location:http://vis.cs.ucdavis.edu/~yus/MAT/index.php";
  header($redirectPath);
}

?>