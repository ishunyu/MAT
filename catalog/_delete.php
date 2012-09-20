<?
require_once "../headers/session.php";

$id_gene = $_POST["id_gene"];

// Deletes the gene from database
$q_del_gene =
  "DELETE FROM $table_genes
   WHERE id=$id_gene";
$r_del_gene = mysql_query($q_del_gene) or die("Gene query unsuccessful");

echo $r_del_gene;

?>