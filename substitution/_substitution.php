<?php
require_once "../headers/session.php";
require_once "../classes/GENE.php";

$gene_q =
  "SELECT gene
   FROM $gene_table
   WHERE id='$_SESSION[gene_id]'";
$gene_r = mysql_query($gene_q) or die("Gene query unsuccessful");
$gene_a = mysql_fetch_assoc($gene_r);

$index = $_POST["index"];
$base = $_POST["base"];
$gene = new GENE($gene_a["gene"]);

$new_codon = $gene->get_codon_base_index($index);
$new_codon[$gene->get_position_in_codon($index) - 1] = $base;
$codon_position = $gene->get_codon_position($index);
$rna_mutation = $gene->rna_mutation($index, $base);
$protein_mutation = $gene->protein_mutation($index, $base);  

if($rna_mutation && $protein_mutation) { ?>
<tr>
  <th>New codon:</th>
  <td><? echo $new_codon; ?></td>
</tr>
<tr>
  <th>Nucleic acid level:</th>
  <td><? echo $rna_mutation; ?></td>
</tr>
<tr>
  <th>Protein level:</th>
  <td><? echo $protein_mutation; ?></td>
</tr>
<? } ?>
