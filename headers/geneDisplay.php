<?php
//Variables for display
$gene0to30 = "";
$geneTitle = "Upload a new Gene";
$geneId = "";

if(isset($_GET['geneID'])){
  $geneId = $_GET['geneID'];	// The latest Gene being worked on
  
  $updateQuery =
    "UPDATE $geneListTableName
     SET modifyTime=NOW()
     WHERE id='$geneId'";
  $updateQuery = mysql_query($updateQuery);
}
else {
  // Gets the genes according to modify time
  $dnaListQuery =
    "SELECT id
     FROM $geneListTableName
     WHERE memberId = $_SESSION[id]
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
  
  $updateQuery =
    "UPDATE $accountsTableName
     SET lastGeneId='$geneId'
     WHERE id='$_SESSION[id]'";
  $updateQuery = mysql_query($updateQuery);
  
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

function hidden_gene_value($geneId) {
  echo "<input type=\"hidden\" name=\"geneId\" value=\"$geneId\" />";
}

function hidden_num_col($numCol) {
  echo "<input type=\"hidden\" name=\"numCol\" value=\"$numCol\" />";
}

?>