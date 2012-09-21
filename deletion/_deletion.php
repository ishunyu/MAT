<?
require_once '../headers/session.php';
require_once '../classes/GENE.php';
require_once '../helpers/length_cdna.php';

$id_gene = $_SESSION['id_gene'];

$start = $_POST['start'];
$end = $_POST['end'];

/* ERROR CHECKING */
/* Make sure the variables are only of numbers */
if(!ctype_digit($start) || !ctype_digit($end))
  die('failed');

$start = (int) $start;
$end = (int) $end;

/* Make sure the the variables are non-negative and that end is at least as large as start */
if(($start <= 0) || ($end <= 0) || ($start > $end))
  die('failed');

if($end > $length_cdna)
  die('failed');


$q_exons =
  "SELECT a.start, a.end, a.name
   FROM shunyu_annotations AS a
   JOIN shunyu_features_global AS global
   WHERE a.id_feature_global = global.id AND global.name = 'Exon'
   ORDER BY a.start";
$r_exons = mysql_query($q_exons);
while($tmp = mysql_fetch_assoc($r_exons)) {
  $exons[] = $tmp;
}

/* INITIATES THE NEW GENE CLASS */
$cdna = new GENE($a_cdna['cdna']);

/* DELETED SEQUENCE */
$len = $end - $start + 1;
$deleted_seq = substr($a_cdna['cdna'], $start - 1, $len);

/* FRAME RETENTION */
$frame_retention = '';
if(($len % 3) == 0) {
  if(($start % 3) == 1) {
    // In-frame
    $frame_retention = 'In-frame';
  }
  else {
    // Non frame-shifting
    $frame_retention = 'Non frame-shifting';
  }
}
else {
  // Frameshift
  $frame_retention = 'Framshift';
}

/* FIRST AFFECTED CODON */
$first_affected_codon = $cdna->get_codon($start);
$codon_info = $cdna->get_codon_info($start);
$amino_acid_position = $cdna->get_codon_position($start);

/* EXON INFO */
$exon = NULL;
$distance_to_5_junction = NULL;
$distance_to_3_junction = NULL;

foreach($exons as $item) {
  if($start >= $item['start'] && $start <= $item['end']) {
    $exon = $item['name'];
    $distance_to_5_junction = $start - $item['start'];
    $distance_to_3_junction = $item['end'] - $start;
  }
}

/* RESULTS */
/* NA LEVEL */
if($start == $end)
  $deletion_only = "c.".$start."del".$deleted_seq;
else
  $deletion_only = "c.".$start."_".$end."del".$deleted_seq;

/* AA LEVEL */
$in_frame_single_aa
= $in_frame_multiple_aa 
= $non_frame_shifting_aa 
= $frame_shifting_aa = '';

if(($len % 3) == 0) {
  if(($start % 3) == 1) {
    // In-frame
    if($len == 3) {
      // Single AA
      $in_frame_single_aa = "p.".$codon_info['3LetterCode'].$amino_acid_position."del";
    }
    else {
      // Multiple AA
      $end_codon_info = $cdna->get_codon_info($end);
      $end_position = $cdna->get_codon_position($end);
      $in_frame_multiple_aa = "p.".$codon_info['3LetterCode'].$amino_acid_position."_".$end_codon_info['3LetterCode'].$end_position."del";
    }
  }
  else {
    // Non frame-shifting
    $end_codon_info = $cdna->get_codon_info($end);
    $end_position = $cdna->get_codon_position($end);
    $non_frame_shifting_aa = "p.".$codon_info['3LetterCode'].$amino_acid_position."_".$end_codon_info['3LetterCode'].$end_position."delins";
    
    $new_codon_info = $cdna->get_new_codon_info($start, $end);
    $non_frame_shifting_aa .= $new_codon_info['3LetterCode'];
  }
}
else {
  // Frameshift
  $new_codon_info = $cdna->get_new_codon_info($start, $end);
  $stop_position = $cdna->stop_codon($start, $end);

  $frame_shifting_aa = "p.".$codon_info['3LetterCode'].$amino_acid_position."fs<br>";
  $frame_shifting_aa .= "p.".$codon_info['3LetterCode'].$amino_acid_position.$new_codon_info['3LetterCode']."fsX".$stop_position;
}

$output = array(
  'deleted_seq' => $deleted_seq,
  'number_of_bases_deleted' => strlen($deleted_seq),
  'frame_retention' => $frame_retention,
  'first_affected_codon' => $first_affected_codon,
  'codon_info' => $codon_info['1LetterCode']."<br>".$codon_info['3LetterCode']."<br>".$codon_info['fullname'],
  'amino_acid_position' => $amino_acid_position,
  'exon' => $exon,
  'distance_to_5_junction' => $distance_to_5_junction,
  'distance_to_3_junction' => $distance_to_3_junction,
  'deletion_only' => $deletion_only,
  'in_frame_single_aa' => $in_frame_single_aa,
  'in_frame_multiple_aa' => $in_frame_multiple_aa,
  'non_frame_shifting_aa' => $non_frame_shifting_aa,
  'frame_shifting_aa' => $frame_shifting_aa
);

echo json_encode($output);
?>