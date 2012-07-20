<?php
//Variables for display
$gene0to30 = "";
$geneTitle = "Upload a new Gene";
$geneId = "";

if(isset($_GET['geneID'])){
  $geneId = $_GET['geneID'];	// The latest Gene being worked on
  $_SESSION['lastGeneId'] = $geneId;
}
else if(isset($_SESSION['lastGeneId']))
  $geneId = $_SESSION['lastGeneId'];  

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

function hidden_value($geneId) {
echo "<input type=\"hidden\" name=\"geneId\" value=\"$geneId\" />";
}

?>