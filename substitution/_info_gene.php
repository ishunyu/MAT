<?php
require_once "../headers/session.php";
require_once "../classes/GENE.php";

$id_gene = $_SESSION['id_gene'];
$id_user = $_SESSION['id_user'];

$q_gene =
  "SELECT cdna
   FROM $table_genes
   WHERE id = $id_gene AND id_user = $id_user";
$r_gene = mysql_query($q_gene) or die("Gene query unsuccessful");
$a_gene = mysql_fetch_assoc($r_gene);

$index = $_POST['index'];


if(!ctype_digit($index) || ((int)$index <= 0))
  die('failed');

$index = (int) $index;

$cdna = new GENE($a_gene['cdna']);

$old_codon = $cdna->get_codon($index);
$codon_position = $cdna->get_codon_position($index);

if($index > $cdna->get_size())
  $index = 'Out of Bound';
?>
<tr>
  <th>Base:</th>
  <td><? echo $index; ?></td>
</tr>
<tr>
  <th>Codon Position:</th>
  <td><? echo $codon_position; ?></td>
</tr>
<tr>
  <th>Old codon:</th>
  <td><? echo $old_codon; ?></td>
</tr>
<? mysql_close($connection); ob_end_flush(); ?>
