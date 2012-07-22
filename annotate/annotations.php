<?php
// Gets the annotation
$annotationQuery =
  "SELECT spec
   FROM $geneListTableName
   WHERE id=$geneId";

$annotationQuery = mysql_query($annotationQuery);
$annotationQuery = mysql_fetch_assoc($annotationQuery);    
$annotation = $annotationQuery['spec']; // Gets the spec portion of the query

if($annotation){  
  $annotation = json_decode($annotation, true);  // Turns json into associative array
  $annotation = array_values($annotation);
  $count = 1;
  
  //echo var_dump($annotation);
  
  for($i = 0; $i < sizeof($annotation); $i++) {?>
    <tr class="specRow" id="specRow">
      <td class="feature">
        <select name="type<? echo $count; ?>" class="geneType" id="type<? echo $count; ?>" onchange="checkCheckbox(this)">
          <option value="2" <? if($annotation[$i][0] == 2) echo "selected=\"selected\""; ?>>m7G Cap</option>
          <option value="3" <? if($annotation[$i][0] == 3) echo "selected=\"selected\""; ?>>promoter</option>
          <option value="4" <? if($annotation[$i][0] == 4) echo "selected=\"selected\""; ?>>5'URT</option>
          <option value="1" <? if($annotation[$i][0] == 1) echo "selected=\"selected\""; ?>>Exon</option>
          <option value="0" <? if($annotation[$i][0] == 0) echo "selected=\"selected\""; ?>>Intron</option>
          <option value="5" <? if($annotation[$i][0] == 5) echo "selected=\"selected\""; ?>>3'URT</option>
          <option value="6" <? if($annotation[$i][0] == 6) echo "selected=\"selected\""; ?>>Poly(A) tail</option>
          <option value="99" <? if($annotation[$i][0] == 99) echo "selected=\"selected\""; ?>>other</option>
        </select></td>
      <td class="id">
        <input type="text" name="id<? echo $count; ?>" class="idInputBox inputBoxStyle" id="id<? echo $count; ?>" 
          value="<? echo $annotation[$i][1]; ?>"/></td>
      <td class="start">
        <input type="text" name="start<? echo $count; ?>" class="geneStartAndEndMarker inputBoxStyle" id="start<? echo $count; ?>"
          value="<? echo $annotation[$i][2]; ?>" onkeydown="return checkInputForNumber(event)"/></td>
      <td class="end">
        <input type="text" name="end<? echo $count; ?>" class="geneStartAndEndMarker inputBoxStyle" id="end<? echo $count; ?>" 
          value="<? echo $annotation[$i][3]; ?>" onkeydown="return checkInputForNumber(event)"/></td>
      <td class="keep">
        <input type="checkbox" name="keep<? echo $count; ?>" class="geneCheckbox" id="keep<? echo $count; ?>"
          <? if($annotation[$i][4]) echo "checked=\"checked\""; ?>/></td>
    </tr> 
  
  <?
    $count++;
  } 
}
else {?>
  <tr class="specRow" id="specRow">
    <td class="feature">
      <select name="type1" class="geneType" id="type1" onchange="checkCheckbox(this)">
        <option value="2">m7G Cap</option>
        <option value="3">promoter</option>
        <option value="4">5'URT</option>
        <option value="1">Exon</option>
        <option value="0">Intron</option>
        <option value="5">3'URT</option>
        <option value="6">Poly(A) tail</option>
        <option value="99">other</option>
      </select></td>
    <td class="id">
      <input type="text" name="id1" class="idInputBox inputBoxStyle" id="id1" /></td>
    <td class="start">
      <input type="text" name="start1" class="geneStartAndEndMarker inputBoxStyle" id="start1" onkeydown="return checkInputForNumber(event)"/></td>
    <td class="end">
      <input type="text" name="end1" class="geneStartAndEndMarker inputBoxStyle" id="end1" onkeydown="return checkInputForNumber(event)"/></td>
    <td class="keep">
      <input type="checkbox" name="keep1" class="geneCheckbox" id="keep1" checked="true"/></td>
  </tr>

<?}
?>