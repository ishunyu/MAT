<?php
// uploader.php
require_once "../db/connectdb.php";
require_once "../headers/session.php";
require_once "../classes/FILES.php";

$name_gene = mysql_real_escape_string($_POST['name_gene']);
$notes = mysql_real_escape_string($_POST['notes']);
$id_user = $_SESSION['id_user'];

// Query the gene list
$q_genes =
  "SELECT *
   FROM $table_genes
   WHERE name='$name_gene' AND m_id='$id_user'";
$r_genes = mysql_query($q_genes) or die("Fetching member's gene information unsuccessful.");

// Check to see if there's a gene with the same name
if(mysql_num_rows($r_genes) > 0) {
  echo "$name_gene is already in your profile.<br>";
}
else {
  // Retrieving file from server space
  $file = getDataFromTempFile($_FILES['uploadedFile']['tmp_name'], pathinfo($_FILES['uploadedFile']['name'], PATHINFO_EXTENSION));
  $data = cleanUploadedData($file);

  // Store information into genelisttable
  $_insert_gene =
    "INSERT INTO $table_genes(id, m_id, name, notes, cdna, gene, file, t_start, t_modify)
     VALUES(NULL, '$id_user', '$name_gene', '$notes', NULL, '$data', '$file', NOW(), NOW())";
  $_insert_gene = mysql_query($_insert_gene)or die("Inserting gene information unsuccessful.");
  
  header("location:../catalog/catalog.php");
}

mysql_close($connection);
ob_end_flush();
?>

