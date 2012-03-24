<?php
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
  $accountName = mysql_real_escape_string(strtolower($_POST['accountName']));
  
  
  $query = "SELECT * FROM $tableName_accountstable WHERE Account='$accountName'";
  $result = mysql_query($query);
  $count = mysql_num_rows($result);
  
  
  if($count == 0) {
    $query_insert = "INSERT INTO $tableName_accountstable(ID, Account, Password, Firstname, Lastname, LastDNAID, LastPage, Lastlogin)
    VALUES(NULL, '$accountName', '$password1', '$firstName', '$lastName', NULL, NULL, NOW())";
    //echo $query_insert;
    $result_insert = mysql_query($query_insert);

    if($result_insert) {
      echo "Success!";
      
      $get_query = "SELECT * FROM $tableName_accountstable WHERE Account='$accountName' and Password='$password1'";
      $get_result = mysql_query($get_query);
      $row = mysql_fetch_assoc($get_result);
      
      session_start();
      $_SESSION['Account'] = $accountName;
      $_SESSION['ID'] = $row['ID'];
      $_SESSION['Firstname'] = $row['Firstname'];

      header("location:upload/upload_dna.php");
      
      echo "HI!";
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

?>