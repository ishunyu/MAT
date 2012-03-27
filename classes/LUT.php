<?php
// DNA Lookup Table! :D

$path = "LUT.csv";
$fh = fopen($path, "r");
$LUT = array();
$labels = array("codon", "3LetterCode", "fullname", "1LetterCode");

while(TRUE) {  
  $data = fgets($fh); // Gets a line from the file
  if($data == "") // End of file check
    break;
  
  $data = trim($data);  // Deletes the space at the end
  $data = explode(",", $data);  // Delimite the line by commas
  
  //echo var_dump($data)."</br>"; // Debug code
  
  $data = array_combine($labels, array_values($data));  // Associate each value with a key name for easier access
  $LUT[$data['codon']] = $data; // Store into the Lookup table each codon along with the name of the codon as the key
}

fclose($fh);

// Loops over each codon and delete unneeded variables
foreach($LUT as &$i) {
  unset($i['codon']);
  //echo var_dump($i)."</br>";
}

// Converting to JSON and formatting the resulting JSON to look pretty
$LUT_JSON = json_encode($LUT);
$LUT_JSON = str_replace(",",",\n",$LUT_JSON);
$LUT_JSON = str_replace("},","\n},\n",$LUT_JSON);
$LUT_JSON = str_replace(":{",":{\n",$LUT_JSON);
$LUT_JSON = str_replace("\"3LetterCode\"","  \"3LetterCode\"",$LUT_JSON);
$LUT_JSON = str_replace("\"fullname\"","  \"fullname\"",$LUT_JSON);
$LUT_JSON = str_replace("\"1LetterCode\"","  \"1LetterCode\"",$LUT_JSON);
$LUT_JSON = str_replace("\"codon\"","  \"codon\"",$LUT_JSON);

$fh=fopen("LUT.json","w");
fwrite($fh, $LUT_JSON);
fclose($fh);

/*  Retrieve data from JSON using one line
$LUT = json_decode(file_get_contents("LUT.json"), TRUE);
echo var_dump($LUT['CTA']);
*/
?>

