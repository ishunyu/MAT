<?php /* _show.php */
require_once "../headers/session.php";
require_once '../helpers/time_custom.php';

$id_gene = $_POST['id_gene'];
$id_user = $_SESSION['id_user'];

$q_gene =
  "SELECT gene, cdna, notes, t_modify
   FROM $table_genes
   WHERE id = $id_gene AND id_user = $id_user";
$r_gene = mysql_query($q_gene) or die("Retrieving gene unsuccessful.");
$a_gene = mysql_fetch_assoc($r_gene);

$cdna = $a_gene['cdna'];
$gene = $a_gene['gene'];
$notes = (strlen($a_gene['notes']) == 0) ? 'none' : $a_gene['notes'];
$time = time_contextual(strtotime($a_gene['t_modify']));

?>
<b>Notes:</b> <? echo $notes; ?><br>
<b>Last modified:</b> <? echo $time; ?><br>
<b>cDNA:</b> (<? echo strlen($cdna); ?>)<br>
<? echo $cdna; ?><br>
<b>Original:</b> (<? echo strlen($gene); ?>)<br>
<? echo $gene; ?>
