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
$q_user =
  "SELECT *
   FROM $table_users
   WHERE username='$username' AND password='$password'";
$q_user = mysql_query($q_user);
$q_user = mysql_fetch_assoc($q_user);

//die(var_dump($q_user));

if($q_user) { // Login success
  session_start();  // Start session
  
  // Set the session variables
  $_SESSION['username'] = $username;
  $_SESSION['id_user'] = $q_user['id'];
  $_SESSION['name_first'] = $q_user['name_first'];
  
  //Set the t_login
  $q_t_login = 
    "UPDATE $table_users
     SET t_login=NOW()
     WHERE id='$q_user[id]'";
  $q_t_login = mysql_query($q_t_login) or die("Update login time unsuccessful");
  
  // Set cookies
  //setcookie($username, );
  
  // Redirect the user
  $path_redirect =
    ($_SERVER["HTTP_HOST"] == "localhost") ?
    "location:https://localhost/mat/upload/upload.php" : "location:http://vis.cs.ucdavis.edu/~yus/mat/upload/upload.php";
  header($path_redirect);
}
else {  // Redirect
  $path_redirect =
    ($_SERVER["HTTP_HOST"] == "localhost") ?
    "location:https://localhost/mat/index.php" : "location:http://vis.cs.ucdavis.edu/~yus/mat/index.php";
  header($path_redirect."?loginAttempt=1&username=$_POST[username]");
}
?>
