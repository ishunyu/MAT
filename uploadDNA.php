<?php
include "dbConfig.php";
include "session.php";

$query = "SELECT * FROM $tableName_accountstable WHERE Account='$_SESSION[accountName]'";
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
    <span class="welcomeMemberMessage">Welcome <?php echo $row['Firstname']; ?></span> &nbsp
    <a class="topLink" href="">Exchange</a> &nbsp;
    <a class="topLink" href="">Insertion</a> &nbsp;
    <a class="topLink" href="">Deletion</a> &nbsp; | &nbsp;
    <a class="topLink" href="">Select DNA</a> &nbsp;
    <a class="topLinkSelected" href="uploadDNA.php">Upload DNA</a> &nbsp; | &nbsp;
    <a class="topLink" href="">Account</a>&nbsp;
    <a class="topLink" href="http://www.google.com">Google</a>
    </br>
  </br>
    <form enctype="multipart/form-data" method="POST" action="uploader.php">
      <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
      <table>
        <tr>
          <td>Name your DNA:</td>
          <td><input type="text" name="nameOfDNA" /></td>
        </tr>
        <tr>
            <td>Upload DNA File:</td>
            <td><input type="file" name="uploadedFile" /></td>
        </tr>
        <tr>
          <th colspan="2">OR</th>
        </tr>
        <tr>
            <td class="topAlign">Input your DNA:</td>
            <td><textarea rows="10" cols="30"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Submit!" /></td>
        </tr>
      </table>
    </form>
  </br>
  <a href="/geneMutation/logout.php">Logout</a>
  </body>
</html>
