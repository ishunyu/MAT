<?php
include "globalVariables.php";

// Connecting to mysql
  $connection = mysql_connect($hostName, $username, $password)or die("Cannot connect to SQL");

// Create out database
  mysql_query($query_createDatabase) or die("Database $MATDatabaseName could not be created.");

// Connect to our datatbase
  mysql_select_db($MATDatabaseName)
    or die("Cannot establish connection with database");

// Create table $accountsTableName
  mysql_query($query_accountstable)
    or die("Cannot create table $accountsTableName");

// Create table $geneListTableName
  mysql_query($query_genelisttable)
    or die("Cannot create table $geneListTableName");

// Redirect to main page
  $redirectPath =
    ($_SERVER["HTTP_HOST"] == "localhost") ?
    "location:https://localhost/mat/index.php" : "location:http://vis.cs.ucdavis.edu/~yus/mat/index.php";
  header($redirectPath);

?>