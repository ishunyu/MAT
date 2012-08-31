<?php
// Gets the annotation
$annotationQuery =
  "SELECT spec
   FROM $geneListTableName
   WHERE id=$geneId";

$annotationQuery = mysql_query($annotationQuery);
$annotationQuery = mysql_fetch_assoc($annotationQuery);    
$anno = $annotationQuery['spec']; // Gets the spec portion of the query
$anno = json_decode($anno, true);  // Turns json into associative array
if($anno){  
  unset($anno['max_id']); // Removes the size in the annotations array
  
  // echo var_dump($anno);
  
  foreach($anno as $key => $a) {?>
    <tr class="a_row" id="row<? echo $key; ?>" >
      <td class="controls">
        <a href="#" title="remove" name="<?echo $key;?>" onclick="return remove_annotation(this);">
          <img src="../images/icons/trash_white.png" height="15" width="" /></a>
        <a href="#" title="edit" onclick="activate_row(this)">
          <img src="../images/icons/file_3_white.png" height="15" width="" /></a>
      </td>
      <td class="feature_s"><? echo stripcslashes($a['ftr']);?></td>
      <td class="ida">  <? echo $a['ida']; ?></td>
      <td class="start"><? echo $a['st']; ?></td>
      <td class="end">  <? echo $a['end']; ?></td>
      <td class="keep"> <? if($a['kp'] == "true") echo "Yes";
                            else echo "No"; ?></td>
    </tr>
  <?
  } 
}
?>
