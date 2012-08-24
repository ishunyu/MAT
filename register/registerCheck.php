<?php
require_once "../headers/databaseConfig.php";

$firstName = mysql_real_escape_string($_POST['firstName']);
$lastName = mysql_real_escape_string($_POST['lastName']);
$password1 = md5(mysql_real_escape_string($_POST['password1']));
$password2 = md5(mysql_real_escape_string($_POST['password2']));
$username = mysql_real_escape_string(strtolower($_POST['username']));

$userQuery =
  "SELECT *
   FROM $accountsTableName
   WHERE username='$username'";
$userQuery = mysql_query($userQuery);
$count = mysql_num_rows($userQuery);


if($count == 0) {
  $userInsertQuery =
    "INSERT INTO $accountsTableName(id, username, password, firstName, lastName, lastGeneId, lastPage, lastLoginTime, startTime)
    VALUES(NULL, '$username', '$password1', '$firstName', '$lastName', NULL, NULL, NOW(), NOW())";
  //die($connection);
  $userInsertQuery = mysql_query($userInsertQuery) or die("Register unsuccessful");

  if($userInsertQuery) {
    $userQuery = "SELECT * FROM $accountsTableName WHERE username='$username' and Password='$password1'";
    $userQuery = mysql_query($userQuery) or die("Retrieving user information unsuccessful");
    $userQuery = mysql_fetch_assoc($userQuery);
    
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $userQuery['id'];
    $_SESSION['lastGeneId'] = $userQuery['lastGeneId'];
    $_SESSION['firstName'] = $userQuery['firstName'];
    $_SESSION['lastLoginTime'] = $userQuery['lastLoginTime'];

    $redirectPath =
      ($_SERVER["HTTP_HOST"] == "localhost") ?
      "location:https://localhost/mat/upload/upload.php" : "location:http://vis.cs.ucdavis.edu/~yus/mat/upload/upload.php";
    header($redirectPath);
  }
}
else {
  die("You got here!");
  $redirectPath =
    ($_SERVER["HTTP_HOST"] == "localhost") ?
    "location:https://localhost/mat/register/register.php" : "location:http://vis.cs.ucdavis.edu/~yus/mat/register/register.php";
  header($redirectPath);
}


?>