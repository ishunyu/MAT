<?php
include "db_config.php";
include "check_session.php";

$query = "SELECT * FROM $tableName_accountstable WHERE Account='$_SESSION[accountName]'";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);

// Create the new account directory
$rootDirectory = "data";
$accountName = $_SESSION['accountName'];
$newDirPath = $rootDirectory."\\".$accountName;

if(!file_exists($newDirPath)) {
  mkdir($newDirPath);
  echo "Made new client directory!".PHP_EOL;
}

?>