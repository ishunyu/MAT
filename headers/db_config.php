<?php
include "global_variables.php";

// Connecting to mysql
  $connection = mysql_connect($hostName, $userName, $password)
    or die("Cannot connect to SQL");

// Connect to our database
  mysql_select_db($databaseName_geneMutationDatabase)
  // If cannot connect to database, then try creating database
    or header("location:headers/create_database.php");



?>