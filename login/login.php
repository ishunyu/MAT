<?php
$loginSuccess = FALSE; // Variable used for displaying retry message

session_start();
if(isset($_SESSION['accountName'])) {
  //echo $_SESSION['accountName']."</br>";
  header("location:upload/upload_dna.php");
}
else {
  //echo "Not Logged on"."</br>";
  session_destroy();
}

//echo var_dump($_POST);

if(count($_POST) != 2) {
  $loginSuccess = TRUE;
}

if(count($_POST) == 2) {
  // username and password sent from form
  $accountName = $_POST['accountName'];
  $password = $_POST['password'];

  // MySQL injection prevention
  $accountName = mysql_real_escape_string(strtolower($accountName));
  $password = md5(mysql_real_escape_string($password));

  // Debug
  //echo $accountName."</br>";
  //echo $password."</br>";

  // Query to the database for account info
  $query = "SELECT * FROM $tableName_accountstable WHERE Account='$accountName' and Password='$password'";
  $result = mysql_query($query);
  $row = mysql_fetch_assoc($result);
  $count = mysql_num_rows($result);

  // Processing Code
  if($count == 1) {
    session_start();
    $_SESSION['Account'] = $accountName;
    $_SESSION['ID'] = $row['ID'];
    $_SESSION['LastDNAID'] = $row['LastDNAID'];
    $_SESSION['Firstname'] = $row['Firstname'];
    $loginSuccess = TRUE;
    header("location:upload/upload_dna.php");
  }
  else {
    //echo "Wrong user name or password!";  //Debug
  }
}

?>
