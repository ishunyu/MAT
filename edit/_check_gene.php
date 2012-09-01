<?php
require_once "../headers/session.php";

$geneId = $_POST['geneId'];
$geneName = $_POST['geneName'];
$id = $_SESSION['id'];

$_genes =
  "SELECT id
   FROM $gene_table
   WHERE geneName='$geneName' AND memberId='$id'";
$_genes = mysql_query($_genes) or die("Fetching member's gene information unsuccessful.");
$_rows = mysql_num_rows($_genes);

// Checks for existence
if($_rows > 0) {
  $_genes = mysql_fetch_assoc($_genes);

  // Must be not matching the current gene id, or else it will always be false
  if($_genes['id'] != $geneId) {
    echo 'true';
    return;
  }
}

// If it doesn't exits, return false
echo 'false';
return
?>