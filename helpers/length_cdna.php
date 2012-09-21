<?php /* length_cdna.php */
$id_gene = $_SESSION['id_gene'];
$id_user = $_SESSION['id_user'];

$q_cdna =
  "SELECT cdna
   FROM $table_genes
   WHERE id = $id_gene AND id_user = $id_user";
$r_cdna = mysql_query($q_cdna);
$a_cdna = mysql_fetch_assoc($r_cdna);
$length_cdna = strlen($a_cdna['cdna']);

?>