<?
require_once "../db/connectdb.php";
require_once "../headers/variables.php";

$id_gene = $_POST['id_gene'];

$_gene =
  "SELECT gene, notes, t_modify
   FROM $table_genes
   WHERE id=$id_gene";
$_gene = mysql_query($_gene) or die("Gene query unsuccessful");
$_gene = mysql_fetch_assoc($_gene);

$gene = $_gene["gene"];

echo 'Length: '.strlen($gene);
echo '<br>';
echo 'Last modified: '.$_gene['t_modify'];
echo '<br>';
echo 'Notes: '.$_gene['notes'];
echo '<br><br>';
echo $gene;
?>