<?php
include "dbConfig.php";
include "session.php";

$query = "SELECT * FROM $tableName_accountstable WHERE Account='$_SESSION[accountName]'";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);

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
    <table class="uploadDNAMainTable">
      <tr>
        <td colspan="2">
          <span class="welcomeMemberMessage">&nbsp;&nbsp;Welcome <?php echo $row['Firstname']; ?>!</span>
        </td>
      </tr>
      <tr>
        <td class = "sideBar">
          <table>
            <tr><td><a class="topLink" href="">Replacement</a></tr></td>
            <tr><td><a class="topLink" href="">Insertion</a></tr></td>
            <tr><td> <a class="topLink" href="">Deletion</a></td>
            <tr><td>&nbsp;</tr></td>
            <tr><td><a class="topLink" href="">Select DNA</a></tr></td>
            <tr><td><a class="topLinkSelected" href="uploadDNA.php">Upload DNA</a></tr></td>
            <tr><td>&nbsp;</tr></td>
            <tr><td><a class="topLink" href="">Account</a></tr></td>
            <tr><td><a class="topLink" href="logout.php">Logout</a></tr></td>
          </table>
        </td>
        <td>
          <form enctype="multipart/form-data" method="POST" action="uploader.php">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <table class="uploadDNAInputTable">
              <tr>
                <td class="inputFieldLabel">Name your DNA:</td>
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
                  <td><textarea class="DNAinput"></textarea></td>
              </tr>
              <tr>
                  <td></td>
                  <td><input type="submit" value="Submit!" /></td>
              </tr>
            </table>
          </form>
        </td>
      </tr>
    </table>
  </body>
</html>
