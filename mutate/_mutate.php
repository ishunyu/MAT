<?php
require_once "../headers/session.php";
require_once "../classes/GENE.php";

$geneQuery =
  "SELECT gene
   FROM $geneListTableName
   ORDER BY modifyTime DESC
   LIMIT 1";
$geneQuery = mysql_query($geneQuery) or die("Gene query unsuccessful");
$geneQuery = mysql_fetch_assoc($geneQuery);

$index = $_POST["index"];
$base = $_POST["base"];
$gene = new GENE($geneQuery["gene"]);

$newCodon = $oldCodon = $gene->getCodonAtBaseIndex($index);
$newCodon[$gene->positionInCodonOfBaseIndex($index) - 1] = $base;
$codonPos = $gene->getCodonPositionAtBaseIndex($index);
$rnaMutation = $gene->rnaMutationAtBaseIndexWithBase($index, $base);
$proteinMutation = $gene->proteinMutationAtBaseIndexWithBase($index, $base);  

if($rnaMutation && $proteinMutation) {
  echo "Base: ".$index."<br/>";
  echo "Codon Position: ".$codonPos."<br/>";
  echo "Old codon: ".$oldCodon."<br/>";
  echo "New codon: ".$newCodon."<br/>";
  echo "<hr>";
  echo "Nucleic acid level: ".$rnaMutation."<br/>";
  echo "Protein level: ".$proteinMutation."<br/>";
}
else {
  echo "Base: <br/>";
  echo "Codon Position: <br/>";
  echo "Old codon: <br/>";
  echo "New codon: <br/>";
  echo "<hr>";
  echo "Nucleic acid level: <br/>";
  echo "Protein level: <br/>";
}


//echo var_dump($gene->getLut());
//echo $_POST["base"];


?>
