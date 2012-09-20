<?php
// Global variables to store data
$host="localhost";  // name of the host server
$host_vis = "vis.cs.ucdavis.edu";
$account="shunyu"; // mysql account name
$password="vis@pass";  // mysql account password
$db="shunyu_mat"; // Our database to connect to
$table_users="shunyu_users";  // Table for storing account information
$table_genes="shunyu_genes";  // Table for storing gene information
$table_features = "shunyu_features";
$table_annotations = "shunyu_annotations";

/* Variables for constructing the database */
$q_database =
  "CREATE DATABASE IF NOT EXISTS $db";
$queries = array();

$q_table_users =
  "CREATE TABLE IF NOT EXISTS $table_users(
    id INT NOT NULL AUTO_INCREMENT,
    admin BOOLEAN NOT NULL DEFAULT '0',
    username varchar(225),
    password varchar(32),
    name_first varchar(225),
    name_last varchar(225),
    last_visited varchar(225),
    t_start DATETIME,
    t_login DATETIME,
    PRIMARY KEY(id)
  )";
$queries[] = $q_table_users;

$q_table_genes =
  "CREATE TABLE IF NOT EXISTS $table_genes(
    id INT NOT NULL AUTO_INCREMENT,
    m_id INT NOT NULL,
    name varchar(225),
    notes text,
    gene mediumtext,
    cdna mediumtext,
    file mediumtext,    
    t_start DATETIME,
    t_modify DATETIME,
    PRIMARY KEY(id),
    FOREIGN KEY(m_id) REFERENCES $table_users(id) ON DELETE CASCADE
  )";
$queries[] = $q_table_genes;

$q_table_features =
  "CREATE TABLE IF NOT EXISTS $table_features(
    id INT NOT NULL AUTO_INCREMENT,    
    m_id INT,
    name varchar(225),
    global BOOLEAN NOT NULL DEFAULT '0',
    PRIMARY KEY(id),
    FOREIGN KEY(m_id) REFERENCES $table_users(id) ON DELETE CASCADE
  )";
$queries[] = $q_table_features;


$q_table_annotations = 
  "CREATE TABLE IF NOT EXISTS $table_annotations(
    id BIGINT NOT NULL AUTO_INCREMENT,
    m_id INT NOT NULL,
    a_id INT,
    name varchar(30),
    start INT NOT NULL,
    end INT NOT NULL,
    feature INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(m_id) REFERENCES $table_users(id) ON DELETE CASCADE,
    FOREIGN KEY(a_id) REFERENCES $table_features(id) ON DELETE SET NULL
  )";
$queries[] = $q_table_annotations;

?>