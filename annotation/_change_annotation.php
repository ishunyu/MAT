<?php /* _change_annotation.php */
require_once "../headers/session.php";
require_once "../classes/GENE.php";

/* Variables */
$id_gene = $_SESSION['id_gene'];

$id_annotation = $_POST['id_annotation'];
$id_feature = $_POST['id_feature'];
$scope_feature = $_POST['scope_feature'];
$name_annotation = $_POST['name_annotation'];
$start = $_POST['start'];
$end = $_POST['end'];

/* Error Checking */
$pattern = '/[^0-9]/';
if( ((int)$start > (int)$end) || 
    ($name_annotation == '') || 
    !ctype_digit($start) || 
    !ctype_digit($end) || 
    ((int)$start <= 0){
  die('failed');
}

/* Figure out the correct feature id */
$id_feature_global = ($scope_feature == 'global') ? $id_feature : 'NULL';
$id_feature_user = ($scope_feature == 'user') ? $id_feature : 'NULL';

/* Check for repeats */
$q_annotations =
  "SELECT id
   FROM $table_annotations
   WHERE id != '$id_annotation' AND id_gene='$id_gene' AND name='$name_annotation'";
$r_annotations = mysql_query($q_annotations) or die('Retrieving annotations unsuccessful.');
$count_annotations = mysql_num_rows($r_annotations);

if($count_annotations > 0) {
  die('repeat');
}

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


require_once '../helpers/update_cdna.php';
mysql_close($connection); ob_end_flush();
?>