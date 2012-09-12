<?
$features_q = array(
  "max_id"=> 6,
  "0" => "m7G Cap",
  "1" => "promoter",
  "2" => "5'UTR",
  "3" => "Exon",
  "4" => "Intron",
  "5" => "3'UTR",
  "6" => "Poly(A) tail",
  "7" => "Start codon",
  "8" => "Stop codon",
  "9" => "TSS",
  "10" => "Exon alternate",
);

$features = mysql_escape_string(json_encode($features_q));  // Turns json into associative array
?>