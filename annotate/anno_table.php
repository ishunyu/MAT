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
    <tr class="specRow">
      <td class="feature">        
        <? switch($annotation[$i]['ftr']) {
          case  2:  echo "m7G Cap";       break;
          case  3:  echo "promoter";      break;
          case  4:  echo "5'URT";         break;
          case  1:  echo "Exon";          break;
          case  0:  echo "Intron";        break;
          case  5:  echo "3'URT";         break;
          case  6:  echo "Poly(A) tail";  break;
          case 99:  echo "other";         break; } ?>
      </td>
      <td class="ida">   <? echo $annotation[$i]['ida']; ?></td>
      <td class="start"><? echo $annotation[$i]['st']; ?></td>
      <td class="end">  <? echo $annotation[$i]['end']; ?></td>
      <td class="keep"> <? if($annotation[$i]['kp'] == "true") echo "Yes";
                            else echo "no"; ?></td>
    </tr>
  <?
    $count++;
  } 
}
?>
