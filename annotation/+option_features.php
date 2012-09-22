<?php
/* +features.php */

$q_features_global =
  "SELECT *
   FROM $table_features_global";
$r_features_global = mysql_query($q_features_global);

while($feature_global = mysql_fetch_assoc($r_features_global)) { ?>
  <option class="global" value="<? echo $feature_global['id']; ?>"><? echo $feature_global['name']; ?></option>
<? }

$q_features_user =
  "SELECT id, name
   FROM $table_features_user
   WHERE id_gene = '$id_gene'";

$r_features_user = mysql_query($q_features_user);

while($feature_user = mysql_fetch_assoc($r_features_user)) { ?>
  <option class="user" value="<? echo $feature_user['id']; ?>"><? echo $feature_user['name']; ?></option>
<? } ?>