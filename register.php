<?php
include "dbConfig.php";
$registerSuccess = FALSE; // Variable used for displaying retry message
$result_insert="";

//echo count($_POST);

// Used for signalling try again messages
if(count($_POST) != 5) {
  $registerSuccess = TRUE;
}

if(count($_POST) == 5) {
  $firstName = mysql_real_escape_string($_POST['firstName']);
  $lastName = mysql_real_escape_string($_POST['lastName']);
  $password1 = md5(mysql_real_escape_string($_POST['password1']));
  $password2 = md5(mysql_real_escape_string($_POST['password2']));
  $accountName = md5(mysql_real_escape_string(strtolower($_POST['accountName'])));
  
  $query = "SELECT * FROM $tableName WHERE Account='$accountName'";
  $result = mysql_query($query);
  $count = mysql_num_rows($result);
  
  //echo 
  
  
  if($count == 0) {
    $query_insert = "INSERT INTO $tableName (ID, Account, Password, Firstname, Lastname, Lastlogin)
    VALUES(NULL, '$accountName', '$password1', '$firstName', '$lastName', NOW())";
    $result_insert = mysql_query($query_insert);
    echo 'Success!';
    session_start();
    $_SESSION['accountName'] = $accountName;
    $_SESSION['password'] = $password;
    header("location:main.php");
  }
  else if($count == 1) {
    $registerSuccess = FALSE;
  }
  else
    die('Shouldn\t be here!');  
}

mysql_close($connection);
?>