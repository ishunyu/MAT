<?php
// uploader.php

include "dbConfig.php";
include "session.php";

$geneName = $_POST['nameOfDNA'];

// Looking for member ID
$query_memberID = "SELECT * FROM $tableName_accountstable WHERE Account='$_SESSION[accountName]'";
$result_memberID = mysql_query($query_memberID);
if(!$result_memberID) {
  die("Fetching member information unsuccessful.");
}
$assoc_memberID = mysql_fetch_assoc($result_memberID);
$memberID = $assoc_memberID["ID"];

// Check to see if there's a gene with the same name
$query_getGenes = "SELECT * FROM $tableName_genelisttable WHERE GeneName='$geneName' AND MemberID='$memberID'";
$result_getGenes = mysql_query($query_getGenes);
  // Checks to see if the query was successful
if(!$result_getGenes) {
  die("Fetching member's gene information unsuccessful.");
}

if(mysql_num_rows($result_getGenes) > 0) {
  echo "$geneName is already in your profile."."</br>";
}
else {
  // Store information into genelisttable
  $query_insertGene = "INSERT INTO $tableName_genelisttable(ID, GeneName, MemberID, AddedTime)
  VALUES(NULL, '$geneName', '$memberID', NOW())";
  $result_insertGene = mysql_query($query_insertGene);
  if(!$result_insertGene) {
    die("Inserting gene information unsuccessful.");
  }
  // Creates the new client directory
  $rootDirectory = "data";
  $accountName = $_SESSION['accountName'];
  $fileName = $_FILES['uploadedFile']['name'];
  $newDirPath = $rootDirectory."\\".$accountName."\\".basename($fileName,".txt");
  echo $newDirPath.PHP_EOL;

  // Check to see if the file path exists
  if(!file_exists($newDirPath)) {
    mkdir($newDirPath);
    echo "here!";
  }

  // Move file to the correct directory
  if(move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $newDirPath."\original")){
    echo "The file ".  basename( $_FILES['uploadedFile']['name'])." has been uploaded";
  }
  else {
    echo "There was an error uploading the file, please try again";
    //header("location:uploadDNA.php");
  }
}

mysql_close($connection);
ob_end_flush();
?>
