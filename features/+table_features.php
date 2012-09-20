<?
// Gets the feature
$q_features =
  "SELECT id, name
   FROM $table_features";

$r_features = mysql_query($q_features);   

while($feature = mysql_fetch_assoc($r_features)) { ?>
  <tr class="row_feature" id="row<? echo $feature['id']; ?>">
    <td class="controls" style="width: 50px;">
      <!-- <a href="#" title="remove" name="<?echo $feature['id'];?>" onclick="return remove_feature(this);">
        <img src="../images/icons/trash_white.png" height="15" width="" /></a> -->
    </td>
    <td class="display"><? echo stripcslashes($feature['name']);?></td>
  </tr>
<? } ?>