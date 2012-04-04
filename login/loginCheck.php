<?php
require_once "../headers/databaseConfig.php";

// username and password sent from form
$username = $_POST['username'];
$password = $_POST['password'];

// MySQL injection prevention
$username = mysql_real_escape_string(strtolower($username));
$password = md5(mysql_real_escape_string($password));

// Debug
//echo $username."</br>";
//echo $password."</br>";

// Query to the database for account info
$userQuery =
  "SELECT *
   FROM $accountsTableName
   WHERE username='$username' AND password='$password'";
$userQuery = mysql_query($userQuery);
$userQuery = mysql_fetch_assoc($userQuery);

//die(var_dump($userQuery));

if($userQuery) { // Login success
  session_start();  // Start session
  
  // Set the session variables
  $_SESSION['username'] = $username;
  $_SESSION['id'] = $userQuery['id'];
  $_SESSION['lastGeneId'] = $userQuery['lastGeneId'];
  $_SESSION['firstName'] = $userQuery['firstName'];
  $_SESSION['lastLoginTime'] = $userQuery['lastLoginTime'];
  
  //Set the lastLoginTime
  $updateLoginTime = 
    "UPDATE $accountsTableName
     SET lastLoginTime=NOW()
     WHERE id='$userQuery[id]'";
  $updateLoginTime = mysql_query($updateLoginTime) or die("Update login time unsuccessful");
  
  // Set cookies
  //setcookie($username, );
  
  // Redirect the user
  $redirectPath =
    ($_SERVER["HTTP_HOST"] == "localhost") ?
    "location:https://localhost/MAT/upload/upload.php" : "location:http://vis.cs.ucdavis.edu/~yus/MAT/upload/upload.php";
  header($redirectPath);
}
else {  // Redirect
  $redirectPath =
    ($_SERVER["HTTP_HOST"] == "localhost") ?
    "location:https://localhost/MAT/index.php" : "location:http://vis.cs.ucdavis.edu/~yus/MAT/index.php";
  header($redirectPath."?loginAttempt=1&username=$_POST[username]");
}
?>
