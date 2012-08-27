<?
require_once "../db/connectdb.php";
require_once "../headers/variables.php";

$geneId = $_POST['geneId'];

$_gene =
  "SELECT gene, geneNotes, modifyTime
   FROM $geneListTableName
   WHERE id=$geneId";
$_gene = mysql_query($_gene) or die("Gene query unsuccessful");
$_gene = mysql_fetch_assoc($_gene);

$gene = $_gene["gene"];

echo 'Length: '.strlen($gene);
echo '<br>';
echo 'Last modified: '.$_gene['modifyTime'];
echo '<br>';
echo 'Notes: '.$_gene['geneNotes'];
echo '<br><br>';
echo $gene;
?>