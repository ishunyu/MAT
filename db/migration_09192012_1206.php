<?
require_once './connectdb.php';
require_once '../classes/FEATURES.php';

$q_add_col = "ALTER TABLE $table_users ADD admin BOOLEAN NOT NULL DEFAULT '0' AFTER id";
echo $q_add_col.'<br>';
mysql_query($q_add_col);

$q_del_col = "ALTER TABLE $table_users DROP lastid_gene";
mysql_query($q_del_col);

?>
