<?php
// uploader.php
require_once "../db/connectdb.php";
require_once "../headers/session.php";
require_once "../classes/FILES.php";

$geneName = $_POST['geneName'];
$geneNotes = $_POST['geneNotes'];
$id = $_SESSION['id'];

// Query the gene list
$_genes =
  "SELECT *
   FROM $gene_table
   WHERE geneName='$geneName' AND memberID='$id'";
$_genes = mysql_query($_genes) or die("Fetching member's gene information unsuccessful.");

// Check to see if there's a gene with the same name
if(mysql_num_rows($_genes) > 0) {
  echo "$geneName is already in your profile."."</br>";
}
else {
  // Retrieving file from server space
  $fileData = getDataFromTempFile($_FILES['uploadedFile']['tmp_name'], pathinfo($_FILES['uploadedFile']['name'], PATHINFO_EXTENSION));
  $cleanData = cleanUploadedData($fileData);

  // Store information into genelisttable
  $_insert_gene =
    "INSERT INTO $gene_table(id, geneName, geneNotes, geneOriginal, geneFormatted, gene, spec, memberId, startTime, modifyTime)
     VALUES(NULL, '$geneName', '$geneNotes', '$fileData', '$cleanData', '$cleanData', NULL,'$id', NOW(), NOW())";
  $_insert_gene = mysql_query($_insert_gene)or die("Inserting gene information unsuccessful.");
  
   // Retrive gene ID
  // $_gene_id =
  //   "SELECT id
  //    FROM $gene_table
  //    WHERE geneName='$geneName' AND memberId='$id'";
  // $_gene_id = mysql_query($_gene_id);
  // $_gene_id = mysql_fetch_assoc($_gene_id);
  // $geneId = $_gene_id['id'];
  
  header("location:../catalog/catalog.php"); 
}

mysql_close($connection);
ob_end_flush();
?>

