<?
require_once "../headers/session.php";

$geneId = $_POST["geneId"];

// Deletes the gene from database
$geneQuery =
  "DELETE FROM $gene_table
   WHERE id=$geneId";
$geneQuery = mysql_query($geneQuery) or die("Gene query unsuccessful");

/*
// Gets the last gene id of the user
$lastGeneIdQuery =
  "SELECT lastGeneId
   FROM $user_table
   WHERE id='$_SESSION[id]'";
$lastGeneIdQuery = mysql_query($lastGeneIdQuery) or die("Last gene id query unsuccessful");
$lastGeneIdQuery = mysql_fetch_assoc($lastGeneIdQuery);

$storedLastGeneId = $lastGeneIdQuery["lastGeneId"]; // Gets the stored last gene id

if($storedLastGeneId == $geneId) {
  // Gets the genes according to modify time
  $dnaListQuery =
    "SELECT id
     FROM $gene_table
     WHERE memberId = $_SESSION[id]
     ORDER BY modifyTime DESC
     LIMIT 1";  // Getting the last gene
  $dnaListQuery = mysql_query($dnaListQuery);
  $num_rows = mysql_num_rows($dnaListQuery);  // Get how many rows there are
  
  if($num_rows > 0) {
    $dnaListQuery = mysql_fetch_assoc($dnaListQuery); // Gets the array structure
    // update the last gene id
    $lastGeneIdUpdateQuery =
      "UPDATE $user_table
       SET lastGeneId=$dnaListQuery[id]
       WHERE id='$_SESSION[id]'";
    $lastGeneIdUpdateQuery = mysql_query($lastGeneIdUpdateQuery);
  }
  else {
    $lastGeneIdUpdateQuery =
      "UPDATE $user_table
       SET lastGeneId=NULL
       WHERE id='$_SESSION[id]'";
    $lastGeneIdUpdateQuery = mysql_query($lastGeneIdUpdateQuery);
  }
}*/

echo $geneQuery;

?>