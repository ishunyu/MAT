<?php
include "../headers/check_session.php";

// show the variables
foreach ($_POST as $key => $value) {
    echo "Key: $key; Value: $value<br />";
}

$encoded_spec = json_encode($_POST);  // Encode the spec array into json, LOVE ITTTT~

// Store the specifications
$specQuery =
  "UPDATE $tableName_genelisttable
  SET Spec = '$encoded_spec'
  WHERE id = '$_POST[dnaId]' AND memberid='$_SESSION[id]'";
$specQuery = mysql_query($specQuery) or die("Specifications could not be stored");

// Process the specifications
$dnaQuery =
  "SELECT DNA FROM $tableName_genelisttable
   WHERE id = '$_POST[dnaId]' AND memberid='$_SESSION[id]'";
$dnaQuery = mysql_query($dnaQuery);
$dnaQuery = mysql_fetch_assoc($dnaQuery);

$dna = $dnaQuery['dna'];

?>