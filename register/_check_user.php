<?php
require_once "../db/connectdb.php";

$username = $_POST['username'];

$userListQuery =
  "SELECT * FROM $accountsTableName
   WHERE username='$username'";
$userListQuery = mysql_query($userListQuery) or die("Fetching member's gene information unsuccessful.");


// See what happens
if(mysql_num_rows($userListQuery) > 0) {
  echo "true";
}
else {
  echo "false";
}
?>