<?php /* _submit_annotation.php */
require_once "../headers/session.php";
require_once "../classes/GENE.php";


$id_gene = $_SESSION['id_gene'];

$id_feature = $_POST['id_feature'];
$scope_feature = $_POST['scope_feature'];
$name_annotation = mysql_real_escape_string($_POST['name_annotation']);
$start = $_POST['start'];
$end = $_POST['end'];

require_once '../helpers/validate_features.php';

/* Figure out the correct feature id */
$id_feature_global = ($scope_feature == 'global') ? $id_feature : 'NULL';
$id_feature_user = ($scope_feature == 'user') ? $id_feature : 'NULL';

/* Store the annotation */
$q_add_annotation =
  "INSERT INTO $table_annotations(id, id_gene, id_feature_global, id_feature_user, name, start, end)
   VALUES(NULL, $id_gene, $id_feature_global, $id_feature_user, '$name_annotation', $start, $end)";

$r_add_annotation = mysql_query($q_add_annotation) or die('Adding annotation unsuccessful! :(');

/* Update the cdna only if we have an Exon */
if(($scope_feature == 'global') && ($id_feature == 1)) {
  require_once '../helpers/update_cdna.php';
}

mysql_close($connection); ob_end_flush();
?>