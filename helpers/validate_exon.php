<?php /* validate_exon.php */
require dirname(__FILE__).'/get_exons.php';

/*
AVAILABLE VARIABLES

$start = $_POST['start'];
$end = $_POST['end'];
$exons = array();
while($tmp = mysql_fetch_assoc($r_exons)) {
  $exons[] = $tmp;
}
*/

/* (Start1 <= End2) and (Start2 <= End1) */
if(isset($id_annotation)) {
  foreach ($exons as $exon) {
    if(($start <= $exon['end']) && ($exon['start'] <= $end) && ($exon['id'] != $id_annotation)) {
      die('Overlaps with Exon '.$exon['name'].'!');
    }
  }
}
else {
  foreach ($exons as $exon) {
    if(($start <= $exon['end']) && ($exon['start'] <= $end)) {
      die('Overlaps with Exon '.$exon['name'].'!');
    }
  }
}
?>