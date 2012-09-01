<?php
require_once "../db/connectdb.php";
require_once "../headers/session.php";
require_once "../classes/FILES.php";

$geneId = $_POST['geneId'];
$geneName = $_POST['geneName'];
$geneNotes = $_POST['geneNotes'];
$id = $_SESSION['id'];

// Query the gene list
$_genes =
  "SELECT *
   FROM $gene_table
   WHERE geneName='$geneName' AND memberID='$id'";
$_genes = mysql_query($_genes) or die("Fetching member's gene information unsuccessful.");
if(mysql_num_rows($_genes) > 0) {
  $_genes = mysql_fetch_assoc($_genes);
}

// Check to see if there's a gene with the same name
if($_genes['id'] != $geneId) {
  echo "$geneName is already in your profile."."</br>";
}
else {
  // Store information into genelisttable
  $_update =
    "UPDATE $gene_table
     SET geneName = '$geneName', geneNotes = '$geneNotes', modifyTime = 'NOW()'
     WHERE id = '$geneId'";
  $_update = mysql_query($_update)or die("Updating gene information unsuccessful.");
  
  header("location:../catalog/catalog.php");
}

mysql_close($connection);
ob_end_flush();
?>

