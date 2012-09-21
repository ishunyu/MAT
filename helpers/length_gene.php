<?php /* length_gene.php */
$id_gene = $_SESSION['id_gene'];
$id_user = $_SESSION['id_user'];

$q_gene =
  "SELECT gene
   FROM $table_genes
   WHERE id = $id_gene AND id_user = $id_user";
$r_gene = mysql_query($q_gene);
$a_gene = mysql_fetch_assoc($r_gene);
$length_gene = strlen($a_gene['gene']);

?>