<?php
require_once "../headers/session.php";
require_once "../classes/GENE.php";

// Retrieving the gene & annotation
$geneQuery =
  "SELECT geneFormatted, spec
   FROM $gene_table
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";
$geneQuery = mysql_query($geneQuery); $geneQuery = mysql_fetch_assoc($geneQuery);
$gene = $geneQuery['geneFormatted'];
$anno = $geneQuery['spec'];
$anno = json_decode(stripcslashes($anno), true);

unset($anno[$_POST['id']]);

// Process the gene according to annotations
$gene = new GENE($gene);
$gene->annotate($anno);
$gene = $gene->get_gene();

$j_anno = json_encode($anno);

// Store the annotations
$annoQuery =
  "UPDATE $gene_table
   SET spec = '$j_anno', gene = '$gene', modifyTime=NOW()
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";
$annoQuery = mysql_query($annoQuery) or die("Annotations could not be stored");

echo "success"; 
?>