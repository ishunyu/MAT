<?php
require_once "../db/connectdb.php";

$name_first = mysql_real_escape_string($_POST['name_first']);
$name_last = mysql_real_escape_string($_POST['name_last']);
$password1 = md5(mysql_real_escape_string($_POST['password1']));
$password2 = md5(mysql_real_escape_string($_POST['password2']));
$username = mysql_real_escape_string(strtolower($_POST['username']));

$q_user =
  "SELECT id
   FROM $table_users
   WHERE username='$username'";
$r_user = mysql_query($q_user);
$count = mysql_num_rows($r_user);


if($count == 0) {
  $q_add_user =
    "INSERT INTO $table_users(id, username, password, name_first, name_last, last_visited, t_login, t_start)
    VALUES(NULL, '$username', '$password1', '$name_first', '$name_last', NULL, NOW(), NOW())";
  $r_add_user = mysql_query($q_add_user) or die("Register unsuccessful");

  if($r_add_user) {
    $q_user = "SELECT id
               FROM $table_users
               WHERE username='$username' and password='$password1'";
    $r_user = mysql_query($q_user) or die("Retrieving user information unsuccessful");
    $user = mysql_fetch_assoc($r_user);
    
    session_start();
    $_SESSION['id_user'] = $user['id'];
    $_SESSION['name_first'] = $name_first;

    $redirectPath =
      ($_SERVER["HTTP_HOST"] == "localhost") ?
      "location:https://localhost/mat/upload/upload.php" : "location:http://vis.cs.ucdavis.edu/~yus/mat/upload/upload.php";
    header($redirectPath);
  }
}
else {
  $redirectPath =
    ($_SERVER["HTTP_HOST"] == "localhost") ?
    "location:https://localhost/mat/register/register.php" : "location:http://vis.cs.ucdavis.edu/~yus/mat/register/register.php";
  header($redirectPath);
}


?>