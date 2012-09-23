<?php /* _change_annotation.php */
require_once "../headers/session.php";
require_once "../classes/GENE.php";

/* Variables */
$id_gene = $_SESSION['id_gene'];

$id_annotation = $_POST['id_annotation'];
$id_feature = $_POST['id_feature'];
$scope_feature = $_POST['scope_feature'];
$name_annotation = mysql_real_escape_string($_POST['name_annotation']);
$start = $_POST['start'];
$end = $_POST['end'];

require_once '../helpers/validate_features.php';

/* Figure out the correct feature id */
$id_feature_global = ($scope_feature == 'global') ? $id_feature : 'NULL';
$id_feature_user = ($scope_feature == 'user') ? $id_feature : 'NULL';

/* Change the annotation */
$q_change_annotation =
  "UPDATE $table_annotations
   SET id_feature_global = $id_feature_global,
       id_feature_user = $id_feature_user,
       name = '$name_annotation',
       start = $start,
       end = $end
   WHERE id = $id_annotation AND id_gene = $id_gene";

$r_change_annotation = mysql_query($q_change_annotation) or die('Change annotation unsuccessful.');

/* Update the cdna only if we have an Exon */
if(($scope_feature == 'global') && ($id_feature == 1)) {
  require_once '../helpers/update_cdna.php';
}
mysql_close($connection); ob_end_flush();
?>