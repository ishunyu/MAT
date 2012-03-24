<?php
// Global variables to store data
$hostName="localhost";  // name of the host server
$hostName_vis = "vis.cs.ucdavis.edu";
$userName="shunyu"; // mysql account name
$password="vis@pass";  // mysql account password
$databaseName_geneMutationDatabase="shunyu_database_genemutation"; // Our database to connect to
$tableName_accountstable="shunyu_table_accounts";  // Table for storing account information
$tableName_genelisttable="shunyu_table_genes";  // Table for storing gene information

$query_createDatabase = "CREATE DATABASE IF NOT EXISTS $databaseName_geneMutationDatabase";

$query_accountstable = "CREATE TABLE IF NOT EXISTS $tableName_accountstable(
ID INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(ID),
Account varchar(32),
Password varchar(32),
Firstname varchar(225),
Lastname varchar(225),
LastDNAID INT,
LastPage varchar(225),
Lastlogin DATETIME
)";

$query_genelisttable = "CREATE TABLE IF NOT EXISTS $tableName_genelisttable(
ID INT NOT NULL AUTO_INCREMENT,
DNAName varchar(225),
DNANote text,
DNAOriginal mediumtext,
DNAFormatted mediumtext,
DNA mediumtext,
Spec text,
MemberID INT NOT NULL,
AddedTime DATETIME,
PRIMARY KEY(ID),
FOREIGN KEY(MemberID) REFERENCES $tableName_accountstable(ID)
)";
?>