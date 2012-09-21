<?php
require_once "../headers/session.php";

$id_gene = $_POST['id_gene'];
$name_gene = $_POST['name_gene'];
$id_user = $_SESSION['id_user'];

$q_genes =
  "SELECT id
   FROM $table_genes
   WHERE name='$name_gene' AND id_user='$id_user'";
$r_genes = mysql_query($q_genes) or die("Fetching member's gene information unsuccessful.");
$rows = mysql_num_rows($r_genes);

// Checks for existence
if($rows > 0) {
  $gene = mysql_fetch_assoc($r_genes);

  // Must be not matching the current gene id, or else it will always be false
  if($gene['id'] != $id_gene) {
    echo 'true';
    return;
  }
}

// If it doesn't exits, return false
echo 'false';
return
?>