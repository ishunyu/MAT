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
  $userName = mysql_real_escape_string(strtolower($_POST['userName']));
  
  
  $query =
    "SELECT *
     FROM $tableName_accountstable
     WHERE userName='$userName'";
  $result = mysql_query($query);
  $count = mysql_num_rows($result);
  
  
  if($count == 0) {
    $query_insert = "INSERT INTO $tableName_accountstable(id, userName, password, firstName, lastName, lastDnaId, lastPage, loginTime, startTime)
    VALUES(NULL, '$userName', '$password1', '$firstName', '$lastName', NULL, NULL, NOW(), NOW())";
    //echo $query_insert;
    $result_insert = mysql_query($query_insert);

    if($result_insert) {      
      $get_query = "SELECT * FROM $tableName_accountstable WHERE userName='$userName' and Password='$password1'";
      $get_result = mysql_query($get_query);
      $row = mysql_fetch_assoc($get_result);
      
      session_start();
      $_SESSION['userName'] = $userName;
      $_SESSION['id'] = $row['ID'];
      $_SESSION['firstName'] = $row['firstName'];

      header("location:upload/upload.php");
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