<?php
require_once "../headers/session.php";
require_once "../classes/GENE.php";

$gene_q =
  "SELECT gene
   FROM $table_genes
   WHERE id='$_SESSION[gene_id]'";
$gene_r = mysql_query($gene_q) or die("Gene query unsuccessful");
$gene_a = mysql_fetch_assoc($gene_r);

$index = $_POST['index'];

if(!ctype_digit($index))
  die('failed');

$index = (int) $index;
// Make sure the the variables are non-negative
if(($index <= 0))
  die('failed');

$gene = new GENE($gene_a['gene']);

$old_codon = $gene->get_codon_base_index($index);
$codon_position = $gene->get_codon_position($index);

if($index > $gene->get_size())
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
