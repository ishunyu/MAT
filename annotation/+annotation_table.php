<?php
// Gets the annotation
$q_annotations =
  "SELECT * 
   FROM
     ((SELECT a.id, a.name, global.name AS feature, a.start, a.end
     FROM shunyu_annotations AS a JOIN shunyu_features_global AS global
     WHERE a.id_feature_global = global.id AND a.id_gene = '$id_gene')
     UNION
     (SELECT a.id, a.name, user.name AS feature, a.start, a.end
     FROM shunyu_annotations AS a JOIN shunyu_features_user AS user
     WHERE a.id_feature_user = user.id AND a.id_gene = '$id_gene')) total
   ORDER BY id";

$r_annotations = mysql_query($q_annotations);
$count = mysql_num_rows($r_annotations);

if($count > 0){
  while($annotation = mysql_fetch_assoc($r_annotations)) {?>
    <tr class="a_row" id="row<? echo $annotation['id']; ?>" >
      <td class="controls">
        <a href="#" title="remove" name="<?echo $annotation['id'];?>" onclick="return remove_annotation(this);">
          <img src="../images/icons/trash_white.png" height="15" width="" /></a>
        <a href="#" title="edit" onclick="activate_row(this)">
          <img src="../images/icons/file_3_white.png" height="15" width="" /></a>
      </td>
      <td class="show_feature"><? echo stripcslashes($annotation['feature']);?></td>
      <td class="name_annotation">  <? echo $annotation['name']; ?></td>
      <td class="start"><? echo $annotation['start']; ?></td>
      <td class="end">  <? echo $annotation['end']; ?></td>
    </tr>
  <?
  } 
}
?>
