<?php
$loginSuccess = FALSE; // Variable used for displaying retry message

session_start();
if(isset($_SESSION['userName'])) {
  header("location:upload/upload.php");
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
  $userName = $_POST['userName'];
  $password = $_POST['password'];

  // MySQL injection prevention
  $userName = mysql_real_escape_string(strtolower($userName));
  $password = md5(mysql_real_escape_string($password));

  // Debug
  //echo $userName."</br>";
  //echo $password."</br>";

  // Query to the database for account info
  $userQuery = "SELECT * FROM $tableName_accountstable WHERE userName='$userName' and password='$password'";
  $userQuery = mysql_query($userQuery) or die("User info query unsuccessful");
  $count = mysql_num_rows($userQuery);
  $userQuery = mysql_fetch_assoc($userQuery);
  
  // Processing Code
  if($count == 1) {
    session_start();
    $_SESSION['userName'] = $userName;
    $_SESSION['id'] = $userQuery['ID'];
    $_SESSION['lastGeneId'] = $userQuery['lastGeneId'];
    $_SESSION['firstName'] = $userQuery['firstName'];
    $loginSuccess = TRUE;
    header("location:upload/upload.php");
  }
  else {
    //echo "Wrong user name or password!";  //Debug
  }
}

?>
