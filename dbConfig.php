<?php
// Variables to store data
$hostName="localhost";
$userName="root";
$password="canttouchthis";
$databaseName_exampleaccountsdatabase="exampleaccountsdatabase";
$tableName_accountstable="accountstable";
$tableName_genelisttable="genelisttable";
$bool_accountstable = FALSE;
$bool_genelisttable = FALSE;

// Connecting to database
$connection = mysql_connect($hostName, $userName, $password)or die("Cannot connect to SQL");
$databaseStatus = mysql_select_db($databaseName_exampleaccountsdatabase)or die("Cannot select the correct Database");

// Query to get the existing tables
$query_showtables = "SHOW TABLES";
$tableList = mysql_query($query_showtables);

// Check the query to see if tables are present
while($tableRow = mysql_fetch_row($tableList)) {
  // accountstable
  if($tableRow[0] == $tableName_accountstable) {
    $bool_accountstable = TRUE;
  }
  // genelisttable
  if($tableRow[0] == $tableName_genelisttable) {
    $bool_genelisttable = TRUE;
  }
}

// If a table is not present, make it
// CREATE accountstable
if(!$bool_accountstable) {
  $query_accountstable = "CREATE TABLE $tableName_accountstable(
  ID INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(ID),
  Account varchar(32),
  Password varchar(32),
  Firstname varchar(225),
  Lastname varchar(225),
  Lastlogin DATETIME
  )";
  
  $result_accountstable = mysql_query($query_accountstable);
  if($result_accountstable) {
    echo "Creating $tableName_accountstable SUCCESSFUL!"."</br>";
  }
  else {
    echo "Creating $tableName_accountstable FAILED!"."</br>";
  }
}

// CREATE genelisttable
if(!$bool_genelisttable) {
  $query_genelisttable = "CREATE TABLE $tableName_genelisttable(
  ID INT NOT NULL AUTO_INCREMENT,
  GeneName varchar(225),
  MemberID INT NOT NULL,
  AddedTime DATETIME,
  PRIMARY KEY(ID),
  FOREIGN KEY(MemberID) REFERENCES $tableName_accountstable(ID)
  )";
  
  $result_genelisttable = mysql_query($query_genelisttable);
  /*if($result_genelisttable) {
    echo "Creating $tableName_genelisttable SUCCESSFUL!"."</br>";
  }
  else {
    echo "Creating $tableName_genelisttable FAILED!"."</br>";
  }*/
}

?>