<?php



// username and password sent from form
$accountName = $_POST['accountName'];
$password = $_POST['password'];

// MySQL injection prevention
//$accountName = stripslashes($accountName);
//$password = stripslashes($password);
$accountName = md5(mysql_real_escape_string($accountName));
$password = md5(mysql_real_escape_string($password));

// Debug
echo $accountName."</br>";
echo $password."</br>";

// Query to the database
$query = "SELECT * FROM $tableName WHERE Account='$accountName' and Password='$password'";
$result = mysql_query($query);
$count = mysql_num_rows($result);

// Processing Code
if($count == 1) {
  session_start();
  $_SESSION['accountName'] = $accountName;
  $_SESSION['password'] = $password;
  head("location:loginOK.php");
}
else {
  echo "Wrong user name or password!";
  die();
}

ob_end_flush();
?>

</br>
<a href="https://localhost/geneMutation">Login Page</a>
