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

if(!$anno)  // If there's no annotation, make sure an array is made
  $anno = array();

$anno[] = array(
                "id" => sizeof($anno),
                "ftr" => $_POST['feature'],
                "ida" => $_POST['ida'],
                "st" => $_POST['start'],
                "end" => $_POST['end'],
                "kp" => $_POST['keep']
                );

// die(var_dump($anno));

// Process the gene according to annotations
$gene = new gene($gene);
$annotation = $gene->annotate($anno, $_POST['numCol']);
$gene = $gene->getGene();


// Store the annotations
$annoQuery =
  "UPDATE $geneListTableName
   SET spec = '$annotation', gene = '$gene', modifyTime=NOW()
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";
$annoQuery = mysql_query($annoQuery) or die("Annotations could not be stored");

// header("location:success.php"); 
?>