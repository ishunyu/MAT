<?php /* validate_exon.php */
require_once dirname(__FILE__).'/get_exons.php';

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
foreach ($exons as $exon) {
  if(($start <= $exon['end']) && ($exon['start'] <= $end)) {
    die('Overlaps with Exon '.$exon['name'].'!');
  }
}
?>