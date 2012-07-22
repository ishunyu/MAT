<?
require_once "../headers/databaseConfig.php";
require_once "../headers/globalVariables.php";

$geneId = $_POST["geneId"];

$geneQuery =
  "DELETE FROM $geneListTableName
   WHERE id=$geneId";
$geneQuery = mysql_query($geneQuery) or die("Gene query unsuccessful");

echo $geneQuery;

?>