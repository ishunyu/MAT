<?php
require_once "../headers/session.php";
require_once "../classes/GENE.php";

// Retrieving the gene & annotation
$geneQuery =
  "SELECT geneFormatted, spec
   FROM $table_genes
   WHERE id = '$_POST[id_gene]' AND m_id='$_SESSION[id_user]'";
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
  "UPDATE $table_genes
   SET spec = '$j_anno', gene = '$gene', t_modify=NOW()
   WHERE id = '$_POST[id_gene]' AND m_id='$_SESSION[id_user]'";
$annoQuery = mysql_query($annoQuery) or die("Annotations could not be stored");

echo "success"; 
?>