<?php
require_once "../db/connectdb.php";

$username = $_POST['username'];

$q_users =
  "SELECT id FROM $table_users
   WHERE username='$username'";
$r_users = mysql_query($q_users) or die("Fetching member's gene information unsuccessful.");


// See what happens
if(mysql_num_rows($r_users) > 0) {
  echo "true";
}
else {
  echo "false";
}
?>