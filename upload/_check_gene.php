<?php
require_once "../headers/session.php";

$name_gene = $_POST['name_gene'];
$id_user = $_SESSION['id_user'];

$geneListQuery =
  "SELECT * FROM $table_genes
   WHERE name='$name_gene' AND id_user='$id_user'";
$geneListQuery = mysql_query($geneListQuery) or die("Fetching member's gene information unsuccessful.");


// See what happens
if(mysql_num_rows($geneListQuery) > 0) {
  echo "true";
}
else {
  echo "false";
}
?>