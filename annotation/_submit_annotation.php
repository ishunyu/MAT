<?php /* _submit_annotation.php */
require_once "../headers/session.php";
require_once "../classes/GENE.php";

$id_user = $_SESSION['id_user'];
$id_gene = $_SESSION['id_gene'];

$id_feature = $_POST['id_feature'];
$scope_feature = $_POST['scope_feature'];
$name_annotation = $_POST['name_annotation'];
$start = $_POST['start'];
$end = $_POST['end'];

if((int)$start > (int)$end) {
  die('failed');
}

/* Retrieves the annotations to check for possible conflicts */
$q_annotations =
  "SELECT id
   FROM $table_annotations
   WHERE id_gene = '$id_gene' AND name = '$name_annotation'";

$r_annotations = mysql_query($q_annotations);
$count_annotations = mysql_num_rows($r_annotations);

if($count_annotations > 0) {
  die('repeat');  // There's a repeat
}

/* Store the annotation */
if($scope_feature == 'global') {
  $q_add_annotation =
    "INSERT INTO $table_annotations(id, id_gene, id_feature_global, id_feature_user, name, start, end)
     VALUES(NULL, '$id_gene', '$id_feature', NULL, '$name_annotation', '$start', '$end')";
}
else if($scope_feature == 'user') {
  $q_add_annotation =
    "INSERT INTO $table_annotations(id, id_gene, id_feature_global, id_feature_user, name, start, end)
     VALUES(NULL, '$id_gene', NULL, '$id_feature', '$name_annotation', '$start', '$end')";
}

$r_add_annotation = mysql_query($q_add_annotation) or die('Adding annotation unsuccessful! :(');


/* Retrieving the gene */
$q_gene =
  "SELECT gene
   FROM $table_genes
   WHERE id = '$id_gene' AND id_member='$id_user'";
$r_gene = mysql_query($q_gene);
$a_gene = mysql_fetch_assoc($r_gene);

$gene = $a_gene['gene'];

/* Retrieving the annotations */
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
$gene->annotate($exons);
$cdna = $gene->get_gene();

// Store the cDNA
$q_add_cdna =
  "UPDATE $table_genes
   SET cdna = '$cdna', t_modify=NOW()
   WHERE id = '$_SESSION[id_gene]' AND id_member='$_SESSION[id_user]'";
$r_add_cdna = mysql_query($q_add_cdna) or die("Annotations could not be stored");

?>