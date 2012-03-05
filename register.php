<?php
include "dbConfig.php";
$registerSuccess = FALSE; // Variable used for displaying retry message
$result_insert="";

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
  
  //echo $_POST['firstName']." ".$_POST['lastName']."</br>".$_POST['password1']." ".$_POST['password2']."</br>".$_POST['accountName']."</br>";
  
  
  $query = "SELECT * FROM $tableName_accountstable WHERE Account='$accountName'";
  $result = mysql_query($query);
  $count = mysql_num_rows($result);
  
  //echo $firstName." ".$lastName."</br>".$accountName."</br>".$password1."</br>";
  //echo "HERE"."</br>";
  
  
  if($count == 0) {
    $query_insert = "INSERT INTO $tableName_accountstable(ID, Account, Password, Firstname, Lastname, Lastlogin)
    VALUES(NULL, '$accountName', '$password1', '$firstName', '$lastName', NOW())";
    echo $query_insert;
    $result_insert = mysql_query($query_insert);
    if($result_insert) {
      echo "Success!";
      session_start();
      $_SESSION['accountName'] = $accountName;
      $_SESSION['password'] = $password;
      header("location:uploadDNA.php");
    }
    else {
      echo "Failed!";
    }
    
  }
  else if($count == 1) {
    $registerSuccess = FALSE;
  }
  else
    die('Shouldn\t be here!');  
}

mysql_close($connection);
?>