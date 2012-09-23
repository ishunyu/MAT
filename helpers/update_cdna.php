<?

$id_user = $_SESSION['id_user'];

/* Retrieving the gene */
$q_gene =
  "SELECT gene
   FROM $table_genes
   WHERE id = $id_gene AND id_user = $id_user";
$r_gene = mysql_query($q_gene);
$a_gene = mysql_fetch_assoc($r_gene);

$gene = $a_gene['gene'];

/* Retrieving the exons*/
require dirname(__FILE__).'/get_exons.php';

// Process the cdna according to exons
$gene = new GENE($gene);
$cdna = $gene->annotate($exons);

// Store the cDNA
$q_process_cdna =
  "UPDATE $table_genes
   SET cdna = '$cdna', t_modify = NOW()
   WHERE id = $id_gene AND id_user = $id_user";

$r_process_cdna = mysql_query($q_process_cdna) or die("Annotations could not be stored");
?>