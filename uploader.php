<?php
// uploader.php

include "dbConfig.php";
session_start();

// Creates the new client directory
$rootDirectory = "data";
$accountName = $_SESSION['accountName'];
$fileName = $_FILES['uploadedFile']['name'];
$newDirPath = $rootDirectory."\\".$accountName."\\".basename($fileName,".txt");
echo $newDirPath.PHP_EOL;

if(!file_exists($newDirPath)) {
  mkdir($newDirPath);
  echo "here!";
}

// Move file to the correct directory
if(move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $newDirPath."\original")){
  //echo "The file ".  basename( $_FILES['uploadedFile']['name'])." has been uploaded";
}
else {
  echo "There was an error uploading the file, please try again";
  //header("location:main.php");
}

mysql_close($connection);
ob_end_flush();
?>

