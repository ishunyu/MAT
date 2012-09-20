<?
require_once '../headers/session.php';

/* Variables */
$id_feature_user = $_POST['id_feature_user'];
$gene_id = $_SESSION['id_gene'];

echo $id_feature_user;

/* Check For Annotations That Are Using This Feature*/
$q_annotations =
  "SELECT id
   FROM $table_annotations
   WHERE id_gene ='$gene_id' AND id_feature_user = '$id_feature_user'";
$r_annotations = mysql_query($q_annotations);
$count_annotations = mysql_num_rows($r_annotations);

if($count_annotations == 0) {
  $q_remove_feature_user =
    "DELETE FROM $table_features_user
     WHERE id = '$id_feature_user'";
  $r_remove_feature_user = mysql_query($q_remove_feature_user);
}
else {
  echo 'used';
}
?>