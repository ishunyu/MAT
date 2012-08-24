<?php
// Global variables to store data
$hostName="localhost";  // name of the host server
$hostName_vis = "vis.cs.ucdavis.edu";
$username="shunyu"; // mysql account name
$password="vis@pass";  // mysql account password
$db="shunyu_mat"; // Our database to connect to
$accountsTableName="shunyu_users";  // Table for storing account information
$geneListTableName="shunyu_genes";  // Table for storing gene information

$query_createDatabase =
  "CREATE DATABASE IF NOT EXISTS $db";

$query_accountstable =
  "CREATE TABLE IF NOT EXISTS $accountsTableName(
    id INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id),
    username varchar(225),
    password varchar(32),
    firstName varchar(225),
    lastName varchar(225),
    lastGeneId INT,
    lastPage varchar(225),
    lastLoginTime DATETIME,
    startTime DATETIME
  )";

$query_genelisttable =
  "CREATE TABLE IF NOT EXISTS $geneListTableName(
    id INT NOT NULL AUTO_INCREMENT,
    features varchar(30),
    geneName varchar(225),
    geneNotes text,
    geneOriginal mediumtext,
    geneFormatted mediumtext,
    gene mediumtext,
    spec text,
    memberId INT NOT NULL,
    startTime DATETIME,
    modifyTime DATETIME,
    PRIMARY KEY(id),
    FOREIGN KEY(memberId) REFERENCES $accountsTableName(id)
  )";
?>