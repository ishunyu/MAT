<?php
// uploader.php

include "../headers/db_config.php";
include "../headers/check_session.php";
include "../classes/class_files.php";

$dnaName = $_POST['dnaName'];
$dnaNotes = $_POST['dnaNotes'];

// Looking for member ID
$idQuery =
  "SELECT * FROM $tableName_accountstable
   WHERE userName='$_SESSION[userName]'";
$idQuery = mysql_query($idQuery) or die("Fetching member information unsuccessful.");
$idQuery = mysql_fetch_assoc($idQuery);
$id = $idQuery["id"];

// Query the gene list
$dnaListQuery =
  "SELECT *
   FROM $tableName_genelisttable
   WHERE dnaName='$dnaName' AND memberID='$id'";
$dnaListQuery = mysql_query($dnaListQuery) or die("Fetching member's gene information unsuccessful.");

// Check to see if there's a gene with the same name
if(mysql_num_rows($dnaListQuery) > 0) {
  echo "$dnaName is already in your profile."."</br>";
}
else {
  // Retrieving file from server space
  $fileData = getDataFromTempFile($_FILES['uploadedFile']['tmp_name']);
  $cleanData = cleanUploadedData($fileData);

  // Store information into genelisttable
  $insertDnaQuery =
    "INSERT INTO $tableName_genelisttable(id, dnaName, dnaNotes, dnaOriginal, dnaFormatted, dna, spec, memberId, addedTime)
     VALUES(NULL, '$dnaName', '$dnaNotes', '$fileData', '$cleanData', '$cleanData', NULL,'$id', NOW())";
  $insertDnaQuery = mysql_query($insertDnaQuery)or die("Inserting gene information unsuccessful.");
  
   // Retrive DNA ID
  $dnaIdQuery =
    "SELECT id
     FROM $tableName_genelisttable
     WHERE dnaName='$dnaName' AND memberId='$id'";
  $dnaIdQuery = mysql_query($dnaIdQuery);
  $dnaIdQuery = mysql_fetch_assoc($dnaIdQuery);
  $dnaId = $dnaIdQuery['id'];
  
  // update User's lastDnaId
  $lastDnaIdQuery =
    "UPDATE $tableName_accountstable
     SET lastDnaId='$dnaId'
     WHERE id='$id'";
  $lastDnaIdQuery = mysql_query($lastDnaIdQuery) or die("Updating lastDnaId unsuccessful!"."</br>");
  
  $_SESSION['lastDnaId'] = $dnaId; // Store lastDnaId into as a session variable
  
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

