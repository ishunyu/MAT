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
$anno = json_decode($anno, true);

if(!$anno) { // If there's no annotation, make sure an array is made
  $anno = array();
  $anno['max_id'] = 0;
}

$anno[$anno['max_id']] = array(
                            "ftr" => $_POST['feature'],
                            "ida" => $_POST['ida'],
                            "st" => (int)$_POST['start'],
                            "end" => (int)$_POST['end']
                            );

$anno['max_id'] += 1;


// Process the gene according to annotations
$gene = new gene($gene);
$gene->annotate($anno);
$gene = $gene->getGene();

$j_anno = json_encode($anno);
$j_anno = mysql_real_escape_string($j_anno);

// Store the annotations
$annoQuery =
  "UPDATE $gene_table
   SET spec = '$j_anno', gene = '$gene', modifyTime=NOW()
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";
$annoQuery = mysql_query($annoQuery) or die("Annotations could not be stored");

// header("location:success.php"); 
echo $anno['max_id'] - 1;
?>