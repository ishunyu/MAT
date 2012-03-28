<?php
session_start();
session_unset();
session_destroy();


// Redirect to main page
$redirectPath =
  ($_SERVER["HTTP_HOST"] == "localhost") ?
  "location:https://localhost/MAT/index.php" : "location:http://vis.cs.ucdavis.edu/~yus/MAT/index.php";
header($redirectPath);
?>
