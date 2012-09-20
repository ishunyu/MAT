<?
require_once '../headers/session.php';

$feature_id = $_POST['feature_id'];
$gene_id = $_SESSION['id_gene'];
$used = false;

// Get the annotations, and check if the feature is being used anywhere here
$annotations_q = "SELECT spec FROM $table_genes WHERE id ='$gene_id'";
$annotations_r = mysql_query($annotations_q);
$annotations_a = mysql_fetch_assoc($annotations_r);
$annotations = json_decode(stripcslashes($annotations_a['spec']), true);
unset($annotations['max_id']);

foreach($annotations as $key => $item) {
  if($item['ftr'] == $feature_id) {
    echo 'used';
    $used = true;
  }
}

if(!$used) {
  // Query the features and turn the JSON text to associative array
  $features_q = "SELECT features FROM $table_genes WHERE id = '$gene_id'";
  $features_r = mysql_query($features_q);
  $features_a = mysql_fetch_assoc($features_r);
  $features = json_decode(stripcslashes($features_a['features']), true);

  // Remove the specified feature, and turn the array back to JSON text
  unset($features[$feature_id]);
  $features_json = mysql_escape_string(json_encode($features));

  $set_features_q = "UPDATE $table_genes SET features = '$features_json' WHERE id='$gene_id'";
  $set_features_r = mysql_query($set_features_q);

  if($set_features_r) {
    echo "true";
  }
  else {
    echo "false";
  }
}
?>