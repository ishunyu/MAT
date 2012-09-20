<?
// Global feature
$q_features_global =
  "SELECT id, name
   FROM $table_features_global";

$r_features_global = mysql_query($q_features_global);

echo '<tr><td>Global:</td><td></td></tr>';
while($feature_global = mysql_fetch_assoc($r_features_global)) { ?>
  <tr class="row_feature" id="global_<? echo $feature_global['id']; ?>">
    <td class="controls" style="width: 50px;">
    </td>
    <td class="display"><? echo stripcslashes($feature_global['name']);?></td>
  </tr>
<? }

// User feature
$q_features_user =
  "SELECT id, name
   FROM $table_features_user
   WHERE id_gene = '$_SESSION[id_gene]'";
$r_features_user = mysql_query($q_features_user);

echo '<tr><td>User:</td><td></td></tr>';
while($feature_user = mysql_fetch_assoc($r_features_user)) { ?>
  <tr class="row_feature" id="user_<? echo $feature_user['id']; ?>">
    <td class="controls" style="width: 50px;">
      <a href="#" title="remove" name="user_<?echo $feature_user['id'];?>" onclick="return remove_feature(this);">
        <img src="../images/icons/trash_white.png" height="15" width="" /></a>
    </td>
    <td class="display"><? echo stripcslashes($feature_user['name']);?></td>
  </tr>
<? }