<?php
include "../headers/session.php";
include "../classes/GENE.php";

// Retrieving the gene & annotation
$geneQuery =
  "SELECT geneFormatted, spec
   FROM $geneListTableName
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";
$geneQuery = mysql_query($geneQuery); $geneQuery = mysql_fetch_assoc($geneQuery);
$gene = $geneQuery['geneFormatted'];
$anno = $geneQuery['spec'];
$anno = json_decode($anno, true);

unset($anno[$_POST['id']]);

// Process the gene according to annotations
$gene = new gene($gene);
$gene->annotate($anno);
$gene = $gene->getGene();

$j_anno = json_encode($anno);

// Store the annotations
$annoQuery =
  "UPDATE $geneListTableName
   SET spec = '$j_anno', gene = '$gene', modifyTime=NOW()
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";
$annoQuery = mysql_query($annoQuery) or die("Annotations could not be stored");

echo "success"; 
?>