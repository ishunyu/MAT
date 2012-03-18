<?php
include "global_variables.php";

// Connecting to mysql
  $connection = mysql_connect($hostName, $userName, $password)or die("Cannot connect to SQL");

// Create out database
  mysql_query($query_createDatabase) or die("Database $databaseName_geneMutationDatabase could not be created.");

// Connect to our datatbase
  mysql_select_db($databaseName_geneMutationDatabase)
    or die("Cannot establish connection with database");

// Create table $tableName_accountstable
  mysql_query($query_accountstable)
    or die("Cannot create table $tableName_accountstable");

// Create table $tableName_genelisttable
  mysql_query($query_genelisttable)
    or die("Cannot create table $tableName_genelisttable");

// If they all succeed, redirect to index.php
  header("location:../index.php");

?>