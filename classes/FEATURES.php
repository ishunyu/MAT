<?
$a_features = array(
  "0" => "Exon",
  "1" => "promoter",
  "2" => "5'UTR",
  "3" => "m7G Cap",
  "4" => "Intron",
  "5" => "3'UTR",
  "6" => "Poly(A) tail"
);

$j_features = mysql_escape_string(json_encode($a_features));  // Turns json into associative array
?>