<?php
include "../headers/check_session.php";
/*
// Create the new account directory
$rootDirectory = "data";
$accountName = $_SESSION['accountName'];
$newDirPath = $rootDirectory."\\".$accountName;


if(!file_exists($newDirPath)) {
  mkdir($newDirPath);
  echo "Made new client directory!".PHP_EOL;
}*/

function check_num_genes($my_tableName) {
  $memberID = $_SESSION['ID'];
  
  // Query the gene list
  $query_getGenes = "SELECT * FROM $my_tableName WHERE MemberID='$memberID'";
  $result_getGenes = mysql_query($query_getGenes);
  // Checks to see if the query was successful
  if(!$result_getGenes) {
    die("Fetching member's gene information unsuccessful.");
  }
  
  //echo var_dump($result_getGenes);
  // Check to see if there's a gene with the same name
  if(mysql_num_rows($result_getGenes) == 0) {
    echo "Let's get started with a new DNA";
  }
  else {
    //echo "Upload a new DNA";
  }
}

?>