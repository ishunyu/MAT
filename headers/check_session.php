<?php
include "db_config.php";
include "global_variables.php";

// Starts/resumes our session
session_start();



// If there's not accountName variables, then user is not logged on
if(!isset($_SESSION['userName'])) {
  session_unset();
  
  // Equivalent to logout, clears all sessions
  session_destroy();
  
  // Redirect to main page
  header("location:../index.php");
}

?>