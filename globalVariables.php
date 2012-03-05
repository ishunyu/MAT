<?php
// Global variables to store data
$hostName="localhost";  // name of the host server
$userName="root"; // mysql account name
$password="canttouchthis";  // mysql account password
$databaseName_geneMutationDatabase="database_genemutation"; // Our database to connect to
$tableName_accountstable="table_accounts";  // Table for storing account information
$tableName_genelisttable="table_genes";  // Table for storing gene information

$query_createDatabase = "CREATE DATABASE IF NOT EXISTS $databaseName_geneMutationDatabase";

$query_accountstable = "CREATE TABLE IF NOT EXISTS $tableName_accountstable(
ID INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(ID),
Account varchar(32),
Password varchar(32),
Firstname varchar(225),
Lastname varchar(225),
Lastlogin DATETIME
)";

$query_genelisttable = "CREATE TABLE IF NOT EXISTS $tableName_genelisttable(
ID INT NOT NULL AUTO_INCREMENT,
GeneName varchar(225),
MemberID INT NOT NULL,
AddedTime DATETIME,
PRIMARY KEY(ID),
FOREIGN KEY(MemberID) REFERENCES $tableName_accountstable(ID)
)";
?>