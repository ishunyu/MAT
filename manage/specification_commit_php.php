<?php
include "../headers/check_session.php";
include "../classes/class_GENE.php";

foreach($_POST as $key => $value) {
  echo $key.": ".$value."</br>";
}

$encodedSpec = json_encode($_POST);  // Encode the spec array into json, LOVE ITTTT~

// Store the specifications
$specQuery =
  "UPDATE $tableName_genelisttable
   SET spec = '$encodedSpec'
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";
$specQuery = mysql_query($specQuery) or die("Specifications could not be stored");

// Retrieving the gene
$geneQuery =
  "SELECT geneFormatted
   FROM $tableName_genelisttable
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";
$geneQuery = mysql_query($geneQuery); $geneQuery = mysql_fetch_assoc($geneQuery);
$gene = $geneQuery['geneFormatted'];

$gene = new gene($gene);
$gene->spec($_POST);
$gene = $gene->getGene();

$updateGeneQuery = 
  "UPDATE $tableName_genelisttable
   SET gene = '$gene'
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";

$updateGeneQuery = mysql_query($updateGeneQuery) or die("Gene could not be stored");
?>












