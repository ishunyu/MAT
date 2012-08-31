<?
require_once '../db/connectdb.php';

$str = array(
  "max_id"=> 6,
  "0" => "m7G Cap",
  "1" => "promoter",
  "2" => "5'UTR",
  "3" => "Exon",
  "4" => "Intron",
  "5" => "3'UTR",
  "6" => "Poly(A) tail"
);

$features = json_encode($str);  // Turns json into associative array

$features = mysql_escape_string($features);

$featuresQ = "update shunyu_genes set features = '$features'";
mysql_query($featuresQ);

?>

