<?php
require_once "connectdb.php";

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
    "location:https://localhost/mat/index.php" : "location:http://vis.cs.ucdavis.edu/~yus/mat/index.php";
  header($redirectPath);
}

?>