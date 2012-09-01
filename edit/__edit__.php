<?
require_once "../headers/session.php";

//Variables for display
$geneName = '';
$geneId = '';
$geneNotes = '';

// Checks for get variable & its validity
if(isset($_GET['geneId'])){
  // Check to see if the gene is part of member's gene lists
  $checkQuery = 
    "SELECT *
     FROM $gene_table
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

if($geneId != '') {
  // Query for the working Gene
  $geneQuery = 
    "SELECT geneName, geneNotes
     FROM $gene_table
     WHERE id='$geneId'";
  $geneQuery = mysql_query($geneQuery);
  $geneQuery = mysql_fetch_assoc($geneQuery);

  $geneName = $geneQuery['geneName'];
  $geneNotes = $geneQuery['geneNotes'];

  $updateQuery =
    "UPDATE $gene_table
     SET modifyTime=NOW()
     WHERE id='$geneId'";
  $updateQuery = mysql_query($updateQuery);
}
else {  // If there's no get variable
  header("location:../catalog/catalog.php");
}

// FUNCTION
function hidden_gene_value($geneId) {
  echo '<input type="hidden" id="geneId" name="geneId" value="'.$geneId.'" />';
}
?>