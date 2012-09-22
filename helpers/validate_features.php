<?php /* validate_features.php */

/* Error Checking */
if( ((int)$start > (int)$end) || 
    ($name_annotation == '') || 
    !ctype_digit($start) || 
    !ctype_digit($end) || 
    ((int)$start <= 0) ||
    ((int)$end > $length_gene)) {
  die('Something wrong with the input!!!');
}

/* Differentats between submition and changes */
$q_annotations_id_annotation = (isset($id_annotation)) ? "id != '$id_annotation' AND" : '';

/* Check for repeats */
$q_annotations =
  "SELECT id
   FROM $table_annotations
   WHERE $q_annotations_id_annotation id_gene='$id_gene' AND name='$name_annotation'";
$r_annotations = mysql_query($q_annotations) or die('Retrieving annotations unsuccessful.');
$count_annotations = mysql_num_rows($r_annotations);

if($count_annotations > 0) {
  die('This name is in use! Sorry!');
}

if(($scope_feature == 'global') && ($id_feature == 1)) {
  require_once dirname(__FILE__).'/validate_exon.php';
}

?>