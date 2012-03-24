<?php
// uploader.php

include "../headers/db_config.php";
include "../headers/check_session.php";
include "../file_processors/file_processor.php";

$DNAName = $_POST['nameOfDNA'];
$DNANote = $_POST['dnaNotes'];

// Looking for member ID
$query_memberID = "SELECT * FROM $tableName_accountstable WHERE Account='$_SESSION[Account]'";
$result_memberID = mysql_query($query_memberID);
if(!$result_memberID) {
  die("Fetching member information unsuccessful.");
}
$assoc_memberID = mysql_fetch_assoc($result_memberID);
$memberID = $assoc_memberID["ID"];

// Query the gene list
$query_getGenes = "SELECT * FROM $tableName_genelisttable WHERE DNAName='$DNAName' AND MemberID='$memberID'";
$result_getGenes = mysql_query($query_getGenes);
// Checks to see if the query was successful
if(!$result_getGenes) {
  die("Fetching member's gene information unsuccessful.");
}

// Check to see if there's a gene with the same name
if(mysql_num_rows($result_getGenes) > 0) {
  echo "$DNAName is already in your profile."."</br>";
}
else {
  // Handles input right away
  $fileData = getDataFromTempFile($_FILES['uploadedFile']['tmp_name']);
  echo $fileData."<hr>";
  $cleanData = cleanUploadedData($fileData);
  echo $cleanData;

  // Store information into genelisttable
  $query_insertGene = "INSERT INTO $tableName_genelisttable(ID, DNAName, DNANote, DNAOriginal, DNAFormatted, DNA, Spec, MemberID, AddedTime)
  VALUES(NULL, '$DNAName', '$DNANote', '$fileData', '$cleanData', '$cleanData', NULL,'$memberID', NOW())";

  $result_insertGene = mysql_query($query_insertGene);
  if(!$result_insertGene) {
    die("Inserting gene information unsuccessful.");
  }
  
   // Retrive DNA ID
  $query_DNAID = "SELECT * FROM $tableName_genelisttable WHERE DNAName='$DNAName' AND MemberID='$memberID'";
  $result_DNAID = mysql_query($query_DNAID);
  $assoc_DNAID = mysql_fetch_assoc($result_DNAID);
  $DNAID = $assoc_DNAID['ID'];
  
  echo $DNAID;
  
  // update User's LastDNAID
  $query_LastDNAID = "UPDATE $tableName_accountstable SET LastDNAID='$DNAID' WHERE ID='$memberID'";
  $result_LastDNAID = mysql_query($query_LastDNAID);
  if(!$result_LastDNAID) {
    echo "Updating LastDNAID unsuccessful!"."</br>";
  }
  $_SESSION['LastDNAID'] = $DNAID;
  
  header("location:../manage/specification.php");
  
  
  
  
  
  
  
  
  
  
  
  /*
  // Creates the new client directory
  $rootDirectory = "data";
  $Account = $_SESSION['Account'];
  $fileName = $_FILES['uploadedFile']['name'];
  $newDirPath = $rootDirectory."\\".$Account."\\".basename($fileName,".txt");
  echo $newDirPath.PHP_EOL;

  // Check to see if the file path exists
  if(!file_exists($newDirPath)) {
    mkdir($newDirPath);
    echo "Made new client directory!".PHP_EOL;
  }

  // Move file to the correct directory
  if(move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $newDirPath."\original")){
    echo "The file ".  basename( $_FILES['uploadedFile']['name'])." has been uploaded";
  }
  else {
    echo "There was an error uploading the file, please try again";
    //header("location:upload_dna.php");
  }*/
}

mysql_close($connection);
ob_end_flush();
?>

