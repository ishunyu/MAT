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
  
  foreach($anno as $id => $a) {?>
    <tr class="a_row" id="row<? echo $id; ?>" >
      <td><a href="#" title="remove" name="<?echo $id;?>" onclick="return remove_annotation(this);">
          <img src="../images/icons/trash_w.png" height="15" width="" /></a></td>
      <td class="feature_s" ondblclick="return activate_row(this.parentNode, this);"><? echo stripcslashes($a['ftr']);?></td>
      <td class="ida" ondblclick="return activate_row(this.parentNode, this);">  <? echo $a['ida']; ?></td>
      <td class="start" ondblclick="return activate_row(this.parentNode, this);"><? echo $a['st']; ?></td>
      <td class="end" ondblclick="return activate_row(this.parentNode, this);">  <? echo $a['end']; ?></td>
      <td class="keep" ondblclick="return activate_row(this.parentNode, this);"> <? if($a['kp'] == "true") echo "Yes";
                            else echo "No"; ?></td>
    </tr>
  <?
  } 
}
?>
