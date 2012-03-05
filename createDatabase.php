<?php
include "globalVariables.php";

// If the database doesn't exist, make the database
$query_createDatabase = "CREATE DATABASE IF NOT EXISTS $databaseName_geneMutationDatabase";
$result_createDatabase = mysql_query($query_createDatabase);
if(!$result_createDatabase) {
  die("Database $databaseName_geneMutationDatabase could not be created.");
} 

// If a table is not present, make it
$query_accountstable = "CREATE TABLE IF NOT EXISTS $tableName_accountstable(
ID INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(ID),
Account varchar(32),
Password varchar(32),
Firstname varchar(225),
Lastname varchar(225),
Lastlogin DATETIME
)";

$result_accountstable = mysql_query($query_accountstable);


// CREATE genelisttable
$query_genelisttable = "CREATE TABLE IF NOT EXISTS $tableName_genelisttable(
ID INT NOT NULL AUTO_INCREMENT,
GeneName varchar(225),
MemberID INT NOT NULL,
AddedTime DATETIME,
PRIMARY KEY(ID),
FOREIGN KEY(MemberID) REFERENCES $tableName_accountstable(ID)
)";

$result_genelisttable = mysql_query($query_genelisttable);

if($result_accountstable && $result_genelisttable) {
  header("location:index.php");
}
else {
  die("Cannot establish connection or create required tables);
}
?>