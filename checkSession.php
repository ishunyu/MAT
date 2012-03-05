<?php
// Starts/resumes our session
session_start();

// If there's not accountName variables, then user is not logged on
if(!isset($_SESSION['accountName'])) {
  session_unset();
  
  // Equivalent to logout, clears all sessions
  session_destroy();
  
  // Redirect to main page
  header("location:index.php");
}
?>