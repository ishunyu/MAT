<?php
require_once "../db/connectdb.php";

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
$userQ =
  "SELECT *
   FROM $accountsTableName
   WHERE username='$username' AND password='$password'";
$userQ = mysql_query($userQ);
$userQ = mysql_fetch_assoc($userQ);

//die(var_dump($userQ));

if($userQ) { // Login success
  session_start();  // Start session
  
  // Set the session variables
  $_SESSION['username'] = $username;
  $_SESSION['id'] = $userQ['id'];
  $_SESSION['lastGeneId'] = $userQ['lastGeneId'];
  $_SESSION['firstName'] = $userQ['firstName'];
  $_SESSION['lastLoginTime'] = $userQ['lastLoginTime'];
  
  //Set the lastLoginTime
  $updateLoginTime = 
    "UPDATE $accountsTableName
     SET lastLoginTime=NOW()
     WHERE id='$userQ[id]'";
  $updateLoginTime = mysql_query($updateLoginTime) or die("Update login time unsuccessful");
  
  // Set cookies
  //setcookie($username, );
  
  // Redirect the user
  $redirectPath =
    ($_SERVER["HTTP_HOST"] == "localhost") ?
    "location:https://localhost/mat/upload/upload.php" : "location:http://vis.cs.ucdavis.edu/~yus/mat/upload/upload.php";
  header($redirectPath);
}
else {  // Redirect
  $redirectPath =
    ($_SERVER["HTTP_HOST"] == "localhost") ?
    "location:https://localhost/mat/index.php" : "location:http://vis.cs.ucdavis.edu/~yus/mat/index.php";
  header($redirectPath."?loginAttempt=1&username=$_POST[username]");
}
?>
