<?
require_once '../db/connectdb.php';

$test_q = "SELECT id, spec FROM $gene_table";
$test_r = mysql_query($test_q);
while($test_a = mysql_fetch_assoc($test_r)) {
  $id = $test_a['id'];
  $test = json_decode(stripcslashes($test_a['spec']), true);

  foreach($test as $key => $annotation) {
    if(!isset($annotation['ftr']))
      continue;

    $feature = $annotation['ftr'];
    switch ($feature) {
      case "m7G Cap":
        //echo 'here';
        $test[$key]['ftr'] = 0;
        break;
      case "promoter":
        $test[$key]['ftr'] = 1;
        break;
      case "5'UTR":
        $test[$key]['ftr'] = 2;
        break;
      case "Exon":
        $test[$key]['ftr'] = 3;
        break;
      case "Intron":
        $test[$key]['ftr'] = 4;
        break;
      case "3'UTR":
        $test[$key]['ftr'] = 5;
        break;        
      case "Poly(A) tail":
        $test[$key]['ftr'] = 6;
        break;
    };
  }

  $json_annotation =  mysql_real_escape_string(json_encode($test));
  $set_annotation_q = "UPDATE $gene_table SET spec='$json_annotation' WHERE id='$id'";
  mysql_query($set_annotation_q);
}

?>