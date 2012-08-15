<?php
include "../headers/checkSession.php";
include "../classes/class_GENE.php";

// Retrieving the gene & annotation
$geneQuery =
  "SELECT geneFormatted, spec
   FROM $geneListTableName
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
                            "st" => $_POST['start'],
                            "end" => $_POST['end'],
                            "kp" => $_POST['keep']
                            );

$anno['max_id'] += 1;


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

// header("location:success.php"); 
echo $anno['max_id'] - 1;
?>