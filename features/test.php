<?
require_once '../db/connectdb.php';
require_once '../classes/FEATURES.php';

$features_q = "update shunyu_genes set features = '$features'";
mysql_query($features_q);

?>

