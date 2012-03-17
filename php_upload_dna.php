<?php
include "check_session.php";

// Create the new account directory
$rootDirectory = "data";
$accountName = $_SESSION['accountName'];
$newDirPath = $rootDirectory."\\".$accountName;

if(!file_exists($newDirPath)) {
  mkdir($newDirPath);
  echo "Made new client directory!".PHP_EOL;
}

?>