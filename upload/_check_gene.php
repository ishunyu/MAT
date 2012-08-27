<?php
require_once "../headers/session.php";

$geneName = $_POST['geneName'];
$id = $_SESSION['id'];

$geneListQuery =
  "SELECT * FROM $geneListTableName
   WHERE geneName='$geneName' AND memberId='$id'";
$geneListQuery = mysql_query($geneListQuery) or die("Fetching member's gene information unsuccessful.");


// See what happens
if(mysql_num_rows($geneListQuery) > 0) {
  echo "true";
}
else {
  echo "false";
}
?>