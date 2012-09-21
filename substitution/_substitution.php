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

$index = $_POST["index"];
$base = $_POST["base"];
$cdna = new GENE($a_gene["cdna"]);

$new_codon = $cdna->get_codon_base_index($index);
$new_codon[$cdna->get_position_in_codon($index) - 1] = $base;
$codon_position = $cdna->get_codon_position($index);
$rna_mutation = $cdna->rna_mutation($index, $base);
$protein_mutation = $cdna->protein_mutation($index, $base);  

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
