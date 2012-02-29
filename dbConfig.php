<?php
// Variables to store data
$hostName="localhost";
$userName="root";
$password="canttouchthis";
$databaseName="exampleaccountsdatabase";
$tableName="accountstable";


mysql_connect($hostName, $userName, $password)or die("Cannot connect to SQL");
mysql_select_db($databaseName)or die("Cannot select the correct Database");
?>