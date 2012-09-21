<?
require_once "../db/connectdb.php";
require_once "../headers/variables.php";

$id_gene = $_POST['id_gene'];

$q_gene =
  "SELECT cdna, notes, t_modify
   FROM $table_genes
   WHERE id=$id_gene";
$r_gene = mysql_query($q_gene) or die("Gene query unsuccessful");
$a_gene = mysql_fetch_assoc($r_gene);

$cdna = $a_gene["cdna"];

echo 'Length: '.strlen($cdna);
echo '<br>';
echo 'Last modified: '.$a_gene['t_modify'];
echo '<br>';
echo 'Notes: '.$a_gene['notes'];
echo '<br><br>';
echo $cdna;
?>