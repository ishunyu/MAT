<?php
// Global variables to store data
$hostName="localhost";  // name of the host server
$hostName_vis = "vis.cs.ucdavis.edu";
$userName="shunyu"; // mysql account name
$password="vis@pass";  // mysql account password
$databaseName_geneMutationDatabase="shunyu_database_genemutation"; // Our database to connect to
$tableName_accountstable="shunyu_table_accounts";  // Table for storing account information
$tableName_genelisttable="shunyu_table_genes";  // Table for storing gene information

$query_createDatabase =
  "CREATE DATABASE IF NOT EXISTS $databaseName_geneMutationDatabase";

$query_accountstable =
  "CREATE TABLE IF NOT EXISTS $tableName_accountstable(
    id INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id),
    userName varchar(32),
    password varchar(32),
    firstName varchar(225),
    lastName varchar(225),
    lastDnaId INT,
    lastPage varchar(225),
    lastlogin DATETIME,
    startTime DATETIME
  )";

$query_genelisttable =
  "CREATE TABLE IF NOT EXISTS $tableName_genelisttable(
    id INT NOT NULL AUTO_INCREMENT,
    dnaName varchar(225),
    dnaNotes text,
    dnaOriginal mediumtext,
    dnaFormatted mediumtext,
    dna mediumtext,
    spec text,
    memberId INT NOT NULL,
    startTime DATETIME,
    PRIMARY KEY(id),
    FOREIGN KEY(memberId) REFERENCES $tableName_accountstable(id)
  )";
?>