<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>
  <? include "uploadInc.php" ?>
  <meta http-equiv="X-UA-Compatible" content="IE=9" /> 

  <link rel="icon" href="../favicon.ico" type="image/x-icon">   
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/topBar.css">
  <link rel="stylesheet" type="text/css" href="../styles/upload.css">

  
  <script type="text/javascript" src="../scripts/upload.js"></script>
</head>

<body>
    <div class="topBarBackground"></div>
    <!-- MAIN-->
    <div id="div_main">
      <!-- TOP BAR-->
      <div class="topBar" class="">
        <div class="textShadow welcome">Welcome, <? echo $_SESSION['firstName'] ?>!</div>
        <a href="../logout/logout.php" class="textShadow smallLink logout">Logout</a>
        <!-- NAV BAR-->
        <table class="navBar">
          <tr>
            <td class="navBarItem selectedNavBarItem"><a class="navBarItem textShadow" id=""href="../upload/upload.php">Upload</a></td>
            <td class="navBarItem"><a class="navBarItem textShadow" id="" href="../substitution/substitution.php">Substitution</a></td>
            <td class="navBarItem"><a class="navBarItem textShadow" id="" href="../insertion/insertion.php">Insertion</a></td>
            <td class="navBarItem"><a class="navBarItem textShadow" id=""href="../deletion/deletion.php">Deletion</a></td>
            <td class="navBarItem"><a class="navBarItem textShadow" id=""href="../manage/database.php">Database</a></td>
          </tr>
        </table>
      </div>
      <!-- CONTENT-->
      <div class="generalContentContainer roundCorners">
        <span id="uploadTitleBox" class="warningFormat textShadow">
        <? checkIfGenesExist($geneListTableName); ?>
        </span>
        <form id="geneUploadForm" enctype="multipart/form-data" method="POST" action="processUserFile.php" onsubmit="return check_upload();">
          <span class="titleFormat textShadow">Sequence Identifier</span><br/>
          <span class="detailFormat textShadow">Please enter a name, number, ??? number or other ID for your sequence. This is for your reference only.</span>
          <hr>
          <input type="text" name="geneName" id="geneName"  class="inputBoxStyle" maxlength="30" />            
          <span id="geneNameWarning" class="warningFormat textShadow"></span>
          <br/><br/>
          
          <span class="titleFormat textShadow">Upload</span><br/>
          <span class="detailFormat textShadow">Currently accepted sequence file format: TXT, FASTA</span>
          <hr>
          <input type="file" name="uploadedFile" id="uploadedFile"/>
          <span id="uploadFileWarning" class="warningFormat textShadow"></span>
          <br/><br/>
          
          <span class="titleFormat textShadow">Notes</span><br/>
          <span class="detailFormat textShadow">Jot down any notes for yourself</span>
          <hr>
          <textarea id="geneNotes" name="geneNotes" maxlength="65535" onkeyup="word_count_popup(event);"></textarea>
          <br/>
          
          <!--span id="wordCount" class="detailFormat textShadow" >65535 characters left</span><br/-->
          <input type="submit" value="Save" id="uploadSubmitButton" class="submitButton"/>         
        </form>
        
      </div>
    </div>

</body>
</html>
