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

// Make sure the the variables are non-negative and that end is at least as large as start
if(($start <= 0) || ($end <= 0) || ($start > $end))
  die('failed');

// Retrieves the data from the database
$gene_q = "SELECT gene
           FROM shunyu_genes
           WHERE id='$_SESSION[gene_id]'";
$gene_r = mysql_query($gene_q);
$gene_a = mysql_fetch_assoc($gene_r);

// Initiate the gene class
$gene = new GENE($gene_a['gene']);

// Get the length of the deleted sequence
$len = $end - $start + 1;

$deleted_seq = substr($gene_a['gene'], $start, $len);

$frame_retention = '';
if(($len % 3) == 0) {
  if(($start % 3) == 1) {
    // In-frame
    $frame_retention = 'In-frame';
  }
  else {
    // Non frame-shifting
    $frame_retention = 'Non frame-shifting';
  }
}
else {
  // Frameshift
  $frame_retention = 'Framshift';
}
$first_affected_codon = $gene->get_codon($start);
$codon_info = $gene->get_codon_info($first_affected_codon);
$amino_acid_position = $gene->get_codon_position($start);


?>