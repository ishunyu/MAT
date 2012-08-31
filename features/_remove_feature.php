<?
require_once '../headers/session.php';

$feature_id = $_POST['feature_id'];
$gene_id = $_SESSION['gene_id'];

// Query the features and turn the JSON text to associative array
$features_q = "SELECT features FROM shunyu_genes WHERE id = '$gene_id'";
$features_r = mysql_query($features_q);
$features_a = mysql_fetch_assoc($features_r);
$features = json_decode(stripcslashes($features_a['features']), true);

// Remove the specified feature, and turn the array back to JSON text
unset($features[$feature_id]);
$features_json = mysql_escape_string(json_encode($features));

$set_features_q = "UPDATE shunyu_genes SET features = '$features_json' WHERE id='$gene_id'";
$set_features_r = mysql_query($set_features_q);

if($set_features_r) {
  echo "true";
}
else {
  echo "false";
}
?>