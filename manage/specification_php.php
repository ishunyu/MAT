<?php
include "../headers/check_session.php";

//Variables for display
$dna0to30 = "";
$dnaTitle = "Upload a new DNA";

if(isset($_SESSION['lastDnaId'])) {
  $dnaId = $_SESSION['lastDnaId'];	// The latest DNA being worked on
  
  // Query for the working DNA
  $dnaQuery = 
    "SELECT * 
     FROM $tableName_genelisttable
     WHERE id='$dnaId'";
  $dnaQuery = mysql_query($dnaQuery);
  $dnaQuery = mysql_fetch_assoc($dnaQuery);
  
  $dna = $dnaQuery['dna'];
  $dnaTitle = $dnaQuery['dnaName'];
  $dna0to30 = substr($dna, 0, 30);
  $dna0to30 = $dna0to30."...";
}

function hidden_value($dnaId) {
echo "<input type=\"hidden\" name=\"dnaId\" value=\"$dnaId\" />";
}

?>