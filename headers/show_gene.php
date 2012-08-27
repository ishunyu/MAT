<?php
//Variables for display
$gene0to30 = "";
$geneTitle = "Upload a new Gene";
$geneId = "";

// Checks for get variable & its validity
if(isset($_GET['geneId'])){
  // Check to see if the gene is part of member's gene lists
  $checkQuery = 
    "SELECT *
     FROM $geneListTableName
     WHERE memberId = '$_SESSION[id]' AND id='$_GET[geneId]'";
  $checkQuery = mysql_query($checkQuery);
  $num_rows_checkQuery = mysql_num_rows($checkQuery);

  // Checking to see how many results showed up
  if($num_rows_checkQuery != 0) {
    $geneId = $_GET['geneId'];
  }
  else {
    header("location:../headers/easter_egg.php");
  }
}

// In case there's no get variable
if($geneId == "") {
  // Gets the genes according to modify time
  $dnaListQuery =
    "SELECT id, geneName, gene
     FROM $geneListTableName
     WHERE memberId = '$_SESSION[id]'
     ORDER BY modifyTime DESC
     LIMIT 1";  // Getting the last gene
  $dnaListQuery = mysql_query($dnaListQuery);
  $num_rows = mysql_num_rows($dnaListQuery);  // Get how many rows there are
  
  if($num_rows > 0) {
    $dnaListQuery = mysql_fetch_assoc($dnaListQuery); // Gets the array structure
    $geneId = $dnaListQuery['id'];
  }
  
}

if($geneId != "") {
  // Query for the working Gene
  $geneQuery = 
    "SELECT geneName, gene 
     FROM $geneListTableName
     WHERE id='$geneId'";
  $geneQuery = mysql_query($geneQuery);
  $geneQuery = mysql_fetch_assoc($geneQuery);
  
  // $updateQuery =
  //   "UPDATE $accountsTableName
  //    SET lastGeneId='$geneId'
  //    WHERE id='$_SESSION[id]'";
  // $updateQuery = mysql_query($updateQuery);
  
  $gene = $geneQuery['gene'];
  $geneTitle = $geneQuery['geneName'];
  if(strlen($gene) > 30) {
    $gene0to30 = substr($gene, 0, 30);
    $gene0to30 = $gene0to30."...";
  }
  else {
    $gene0to30 = $gene;
  }
  $gene0to30 = "(".$gene0to30.")";
}

$updateQuery =
  "UPDATE $geneListTableName
   SET modifyTime=NOW()
   WHERE id='$geneId'";
$updateQuery = mysql_query($updateQuery);

// FUNCTION
function hidden_gene_value($geneId) {
  echo "<input type=\"hidden\" id=\"geneId\" value=\"$geneId\" />";
}

function hidden_num_col($numCol) { // Needs this for spec of GENE class
  echo "<input type=\"hidden\" id=\"numCol\" value=\"$numCol\" />";
}

?>