<?php /* _submit_annotation.php */
require_once "../headers/session.php";
require_once "../classes/GENE.php";

$id_gene = $_SESSION['id_gene'];

$id_feature = $_POST['id_feature'];
$scope_feature = $_POST['scope_feature'];
$name_annotation = $_POST['name_annotation'];
$start = $_POST['start'];
$end = $_POST['end'];

$pattern = '/[^0-9]/';
if( ((int)$start > (int)$end) || 
    ($name_annotation == '') || 
    !ctype_digit($start) || 
    !ctype_digit($end) || 
    ((int)$start <= 0){
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


require_once '../helpers/update_cdna.php';
mysql_close($connection); ob_end_flush();
?>