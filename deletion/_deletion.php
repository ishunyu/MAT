<?
require_once "../headers/session.php";
require_once "../classes/GENE.php";

$start = $_POST['start'];
$end = $_POST['end'];

// Make sure the variables are only of numbers
if(!ctype_digit($start) || !ctype_digit($end))
  die('failed');

$start = (int) $start;
$end = (int) $end;
// Make sure the the variables are non-negative
if(($start <= 0) || ($end <= 0) || ($start > $end))
  die('failed');

// Retrieves the data from the database
$gene_q = "SELECT gene
           FROM shunyu_genes
           WHERE id='$_SESSION[gene_id]'";
$gene_r = mysql_query($gene_q);
$gene_a = mysql_fetch_assoc($gene_r);

$gene = $gene_a['gene'];

echo $gene;
?>