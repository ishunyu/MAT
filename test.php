<?php
include "DNAdata\DNA_FILE.php";
$LUT = json_decode(file_get_contents("DNAdata\LUT.json"), true);
$output = "";

if(isset($_POST['location'])) {
  $DNA1 = new DNA_FILE($link);
  $codon = $DNA1->getCodonAtIndex($_POST['location']);
  
  $output = $codon.": { ";
  if(isset($LUT[$codon])) {
    foreach($LUT[$codon] as $key => $value) {
      $output = $output.$key.": ".$value.", ";
    }  

    $output[strlen($output)-1] = "}";
    $output[strlen($output)-2] = " ";
  }
  else {
    $output = "";
  }
}

if(isset($_POST['codon'])) {
  $codon = strtoupper($_POST['codon']);
  $output = "<b>".$codon."</b></br>";

  if(isset($LUT[$codon])) {
    foreach($LUT[$codon] as $key => $value) {
      $output = $output.$key.": ".$value.",</br>";
    }  
  }
  else {
    $output = "";
  }
}
?>