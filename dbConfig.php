<?php
include "globalVariables.php";

// Connecting to mysql
$connection = mysql_connect($hostName, $userName, $password)or die("Cannot connect to SQL");

// Connect to our database
$databaseStatus = mysql_select_db($databaseName_geneMutationDatabase)or die("Cannot select the correct Database");

// If cannot connect to database, then try creating database
if(!$databaseStatus) {
  header("location:createDatabase.php");
}
?>