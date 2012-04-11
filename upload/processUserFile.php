<?php
// uploader.php

require_once "../headers/databaseConfig.php";
require_once "../headers/checkSession.php";
require_once "../classes/class_files.php";

$geneName = $_POST['geneName'];
$geneNotes = $_POST['geneNotes'];

// Looking for member ID
$idQuery =
  "SELECT * FROM $accountsTableName
   WHERE username='$_SESSION[username]'";
$idQuery = mysql_query($idQuery) or die("Fetching member information unsuccessful.");
$idQuery = mysql_fetch_assoc($idQuery);
$id = $idQuery["id"];

// Query the gene list
$geneListQuery =
  "SELECT *
   FROM $geneListTableName
   WHERE geneName='$geneName' AND memberID='$id'";
$geneListQuery = mysql_query($geneListQuery) or die("Fetching member's gene information unsuccessful.");

// Check to see if there's a gene with the same name
if(mysql_num_rows($geneListQuery) > 0) {
  echo "$geneName is already in your profile."."</br>";
}
else {
  // Retrieving file from server space
  $fileData = getDataFromTempFile($_FILES['uploadedFile']['tmp_name'], pathinfo($_FILES['uploadedFile']['name'], PATHINFO_EXTENSION));
  $cleanData = cleanUploadedData($fileData);

  // Store information into genelisttable
  $insertDnaQuery =
    "INSERT INTO $geneListTableName(id, geneName, geneNotes, geneOriginal, geneFormatted, gene, spec, memberId, startTime)
     VALUES(NULL, '$geneName', '$geneNotes', '$fileData', '$cleanData', '$cleanData', NULL,'$id', NOW())";
  $insertDnaQuery = mysql_query($insertDnaQuery)or die("Inserting gene information unsuccessful.");
  
   // Retrive gene ID
  $geneIdQuery =
    "SELECT id
     FROM $geneListTableName
     WHERE geneName='$geneName' AND memberId='$id'";
  $geneIdQuery = mysql_query($geneIdQuery);
  $geneIdQuery = mysql_fetch_assoc($geneIdQuery);
  $geneId = $geneIdQuery['id'];
  
  // update User's lastGeneId
  $lastGeneIdQuery =
    "UPDATE $accountsTableName
     SET lastGeneId='$geneId'
     WHERE id='$id'";
  $lastGeneIdQuery = mysql_query($lastGeneIdQuery) or die("Updating lastGeneId unsuccessful!"."</br>");
  
  $_SESSION['lastGeneId'] = $geneId; // Store lastGeneId into as a session variable
  
  header("location:../manage/database.php");  
  
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
    //header("location:upload.php");
  }*/
}

mysql_close($connection);
ob_end_flush();
?>

