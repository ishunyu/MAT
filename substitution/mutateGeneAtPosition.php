<?php
require_once "../headers/checkSession.php";
require_once "../classes/class_GENE.php";

$geneQuery =
  "SELECT gene
   FROM $geneListTableName
   WHERE id='$_SESSION[lastGeneId]'";
$geneQuery = mysql_query($geneQuery) or die("Gene query unsuccessful");
$geneQuery = mysql_fetch_assoc($geneQuery);


$gene = new GENE($geneQuery["gene"]);
echo $gene->getGene();
echo var_dump($gene->getLut());
//echo $_POST["nucleotide"];


?>