<?
require_once '../db/connectdb.php';

$features_q = array(
  "max_id"=> 6,
  "0" => "m7G Cap",
  "1" => "promoter",
  "2" => "5'UTR",
  "3" => "Exon",
  "4" => "Intron",
  "5" => "3'UTR",
  "6" => "Poly(A) tail"
);
$features = mysql_escape_string(json_encode($features_q));  // Turns json into associative array

$features_q = "update shunyu_genes set features = '$features'";
mysql_query($features_q);

?>

