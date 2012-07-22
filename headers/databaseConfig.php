<?php
require_once "globalVariables.php";

// Connecting to mysql
  $connection = mysql_connect($hostName, $username, $password) or die("Cannot connect to SQL");

// Connect to our database
  mysql_select_db($MATDatabaseName) or die("Cannot connect database</br>");
?>