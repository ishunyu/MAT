<?
require_once "../headers/databaseConfig.php";
require_once "../headers/globalVariables.php";

$geneId = $_POST["geneId"];

$geneQuery =
  "SELECT gene,modifyTime
   FROM $geneListTableName
   WHERE id=$geneId";
$geneQuery = mysql_query($geneQuery) or die("Gene query unsuccessful");
$geneQuery = mysql_fetch_assoc($geneQuery);

$gene = $geneQuery["gene"];

echo "Length: ".strlen($gene);
echo "<br>";
echo "Last modified: ".$geneQuery["modifyTime"];
echo "<br><br>";
echo $gene;

?>