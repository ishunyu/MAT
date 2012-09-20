<?php
// Gets the annotation
$q_annotations =
  "SELECT *
   FROM $table_annotations LEFT JOIN $table_features
   WHERE a_id = '$id_gene'";

$r_annotations = mysql_query($q_annotations);
$count = mysql_num_rows($r_annotations);
while($annotations[] = mysql_fetch_assoc($r_annotations));

if($count != 0){  
  foreach($annotations => $annotation) {?>
    <tr class="a_row" id="row<? echo $annotation['id']; ?>" >
      <td class="controls">
        <a href="#" title="remove" name="<?echo $annotation['id'];?>" onclick="return remove_annotation(this);">
          <img src="../images/icons/trash_white.png" height="15" width="" /></a>
        <a href="#" title="edit" onclick="activate_row(this)">
          <img src="../images/icons/file_3_white.png" height="15" width="" /></a>
      </td>
      <td class="feature_s"><? echo stripcslashes($features[$annotation['ftr']]);?></td>
      <td class="name_gene">  <? echo $annotation['name_gene']; ?></td>
      <td class="start"><? echo $annotation['st']; ?></td>
      <td class="end">  <? echo $annotation['end']; ?></td>
    </tr>
  <?
  } 
}
?>
