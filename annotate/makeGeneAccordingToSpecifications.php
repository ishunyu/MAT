<?php
include "../headers/checkSession.php";
include "../classes/class_GENE.php";

// Retrieving the gene
$geneQuery =
  "SELECT geneFormatted
   FROM $geneListTableName
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";
$geneQuery = mysql_query($geneQuery); $geneQuery = mysql_fetch_assoc($geneQuery);
$gene = $geneQuery['geneFormatted'];

// Process the gene according to specifications
$gene = new gene($gene);
$annotation = $gene->spec($_POST);
$gene = $gene->getGene();

echo $annotation;
echo var_dump(json_decode($annotation, true));

// Store the specifications
$specQuery =
  "UPDATE $geneListTableName
   SET spec = '$annotation', gene = '$gene', modifyTime=NOW()
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";
$specQuery = mysql_query($specQuery) or die("Annotations could not be stored");


//echo $gene;

header("location:../catalog/catalog.php"); 
?>












