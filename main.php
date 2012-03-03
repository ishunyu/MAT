<?php
include "dbConfig.php";
session_start();

$query = "SELECT * FROM $tableName WHERE Account='$_SESSION[accountName]'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

// Create the new account directory
$rootDirectory = "data";
$accountName = $_SESSION['accountName'];
$newDirPath = $rootDirectory."\\".$accountName;

if(!file_exists($newDirPath)) {
  mkdir($newDirPath);
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
    <link rel="stylesheet" type="text/css" href="styles/style_main.css">
  </head>
  
  <body>
    <span class="welcomeMemberMessage">Welcome <?php echo $row['Firstname']; ?></span></br>
  </br>
    <form enctype="multipart/form-data" method="POST" action="uploader.php">
      <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
      Name your DNA: <input type="text" name="nameOfDNA" /></br>
      Your DNA file: <input type="file" name="uploadedFile" /></br>
      <input type="submit" value="Here ya go!" />
    </form>
  </br>
  <a href="/geneMutation/logout.php">Logout</a>
  </body>
</html>
