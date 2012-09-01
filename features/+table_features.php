<?
// Gets the feature
$featuresQ =
  "SELECT features
   FROM $gene_table
   WHERE id=$geneId";


$featuresQ = mysql_query($featuresQ);
$featuresQ = mysql_fetch_assoc($featuresQ);    
$features = $featuresQ['features']; // Gets the spec portion of the query
$features = json_decode($features, true);  // Turns json into associative array

unset($features['max_id']);

foreach($features as $key => $item) { ?>
  <tr class="f_row" id="row<? echo $key; ?>">
    <td class="controls" style="width: 50px;">
      <a href="#" title="remove" name="<?echo $key;?>" onclick="return remove_feature(this);">
        <img src="../images/icons/trash_white.png" height="15" width="" /></a>
      <a href="#" title="edit" onclick="activate_row(this)">
        <img src="../images/icons/file_3_white.png" height="15" width="" /></a>
    </td>
    <td class="display"><? echo stripcslashes($item);?></td>
  </tr>
<? } ?>