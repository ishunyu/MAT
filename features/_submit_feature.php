<?
require_once '../headers/session.php';

/* Variables */
$feature_user_new = mysql_real_escape_string($_POST['feature_user_new']);
$id_gene = $_SESSION['id_gene'];

/* User Features*/
$q_features_user =
  "SELECT name
   FROM $table_features_user
   WHERE id_gene = '$id_gene'";
$r_features_user = mysql_query($q_features_user);

/* Check For Existence*/
while($feature_user = mysql_fetch_assoc($r_features_user)) {
  if($feature_user_new == $feature_user['name']) {
    die('repeat');
  }
}

/* Add Into Database */
$q_add_feature_user =
  "INSERT INTO $table_features_user(id, id_gene, name)
   VALUES(NULL, '$id_gene', '$feature_user_new')";
$r_add_feature_user = mysql_query($q_add_feature_user);

?>