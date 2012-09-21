<?

$id_user = $_SESSION['id_user'];

/* Retrieving the gene */
$q_gene =
  "SELECT gene
   FROM $table_genes
   WHERE id = '$id_gene' AND id_member='$id_user'";
$r_gene = mysql_query($q_gene);
$a_gene = mysql_fetch_assoc($r_gene);

$gene = $a_gene['gene'];

/* Retrieving the exons */
$q_exons =
  "SELECT a.start, a.end
   FROM shunyu_annotations AS a
   JOIN shunyu_features_global AS global
   WHERE a.id_feature_global = global.id AND global.name = 'Exon'
   ORDER BY a.start";
$r_exons = mysql_query($q_exons);
while($tmp = mysql_fetch_assoc($r_exons)) {
  $exons[] = $tmp;
}

// Process the cdna according to exons
$gene = new GENE($gene);
$cdna = $gene->annotate($exons);

// Store the cDNA
$q_process_cdna =
  "UPDATE $table_genes
   SET cdna = '$cdna', t_modify=NOW()
   WHERE id = '$_SESSION[id_gene]' AND id_member='$_SESSION[id_user]'";
$r_process_cdna = mysql_query($q_process_cdna) or die("Annotations could not be stored");
?>