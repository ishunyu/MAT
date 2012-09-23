<?
require_once "../headers/session.php";

$id_gene = $_POST['id_gene'];
$id_user = $_SESSION['id_user'];

// Deletes the gene from database
$q_del_gene =
  "DELETE FROM $table_genes
   WHERE id = $id_gene AND id_user = $id_user";
$r_del_gene = mysql_query($q_del_gene) or die("Deleting gene unsuccessful");

echo $r_del_gene;
?>