<?php
include "../headers/check_session.php";

$dnaName = $_POST['dnaName'];
$id = $_SESSION['id'];

$dnaListQuery =
  "SELECT * FROM $tableName_genelisttable
   WHERE dnaName='$dnaName' AND MemberID='$id'";
$dnaListQuery = mysql_query($dnaListQuery) or die("Fetching member's gene information unsuccessful.");


// See what happens
if(mysql_num_rows($dnaListQuery) > 0) {
  echo "true";
}
else {
  echo "false";
}
?>