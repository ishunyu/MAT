<?php
// Gets the annotation
$annotation_q =
  "SELECT spec, features
   FROM $gene_table
   WHERE id=$geneId";

$annotation_q = mysql_query($annotation_q);
$annotation_q = mysql_fetch_assoc($annotation_q);    
$anno = $annotation_q['spec']; // Gets the spec portion of the query
$anno = json_decode(stripcslashes($anno), true);  // Turns json into associative array

$features = json_decode(stripcslashes($annotation_q['features']), true);
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
      <td class="feature_s"><? echo stripcslashes($features[$a['ftr']]);?></td>
      <td class="ida">  <? echo $a['ida']; ?></td>
      <td class="start"><? echo $a['st']; ?></td>
      <td class="end">  <? echo $a['end']; ?></td>
    </tr>
  <?
  } 
}
?>
