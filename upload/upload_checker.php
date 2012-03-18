<?php
include "../headers/db_config.php";
include "../headers/check_session.php";

$geneName = $_POST['titleName'];
$memberID = $row['ID'];

$query_getGenes = "SELECT * FROM $tableName_genelisttable WHERE GeneName='$geneName' AND MemberID='$memberID'";
$result_getGenes = mysql_query($query_getGenes);
// Checks to see if the query was successful
if(!$result_getGenes) {
  die("Fetching member's gene information unsuccessful.");
}

if(mysql_num_rows($result_getGenes) > 0) {
  echo "true";
}
else {
  echo "false";
}
?>