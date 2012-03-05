<?php
include "dbConfig.php";
$loginSuccess = FALSE; // Variable used for displaying retry message

session_start();
if(isset($_SESSION['accountName'])) {
  echo $_SESSION['accountName'];
  echo "what?";
  //header("location:uploadDNA.php");
}
session_destroy();

if(count($_POST) != 2) {
  $loginSuccess = TRUE;
}

if(count($_POST) == 2) {
  // username and password sent from form
  $accountName = $_POST['accountName'];
  $password = $_POST['password'];

  // MySQL injection prevention
  $accountName = md5(mysql_real_escape_string(strtolower($accountName)));
  $password = md5(mysql_real_escape_string($password));

  // Debug
  //echo $accountName."</br>";
  //echo $password."</br>";

  // Query to the database
  $query = "SELECT * FROM $tableName_accountstable WHERE Account='$accountName' and Password='$password'";
  $result = mysql_query($query);
  $count = mysql_num_rows($result);

  // Processing Code
  if($count == 1) {
    session_start();
    $_SESSION['accountName'] = $accountName;
    $loginSuccess = TRUE;
    header("location:uploadDNA.php");
  }
  else {
    //echo "Wrong user name or password!";  //Debug
  }
}

mysql_close($connection);
?>
