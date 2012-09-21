<?php
require_once "../headers/session.php";
require_once "../classes/GENE.php";

$id_gene = $_SESSION['id_gene'];
$id_annotation = $_POST['id_annotation'];

// Retrieving the gene & annotation
$q_remove_annotation =
  "DELETE FROM $table_annotations
   WHERE id = $id_annotation AND id_gene = $id_gene";
$r_remove_annotation = mysql_query($q_remove_annotation) or die("Removing annotation unsuccessful.");

require_once '../helpers/update_cdna.php';
mysql_close($connection); ob_end_flush();
?>