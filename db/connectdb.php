<?php
require_once "../headers/variables.php";

// Connecting to mysql
  $connection = mysql_connect($hostName, $username, $password) or die("Cannot connect to SQL");

// Connect to our database
  mysql_select_db($db) or die("Cannot connect database</br>");
?>