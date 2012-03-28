<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>
  <? include "uploadInc.php" ?>
  <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
  
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/topBar.css">
  
  <link rel="icon" href="../favicon.ico" type="image/x-icon"> 
  
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  
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
            <td class="navBarItem"><a class="navBarItem textShadow" id="" href="../substitution/substitution.php">Substitution</a></td>
            <td class="navBarItem"><a class="navBarItem textShadow" id="" href="../insertion/insertion.php">Insertion</a></td>
            <td class="navBarItem"><a class="navBarItem textShadow" id=""href="../deletion/deletion.php">Deletion</a></td>
            <td class="navBarItem"><a class="navBarItem textShadow" id=""href="../upload/upload.php">Upload</a></td>
            <td class="navBarItem"><a class="navBarItem textShadow" id=""href="../manage/specification.php">Database</a></td>
          </tr>
        </table>
      </div>
      <!-- CONTENT-->
      <div class="contentContainer roundCorners">
        <div id="div_introduction_box" class="textShadow">
        <? checkIfGenesExist($geneListTableName); ?>
        </div>
        <form enctype="multipart/form-data" method="POST" action="processUserFile.php" onsubmit="return check_upload();" id="upload_dna_form">
          <div id="div_content_box_main">
            <div id="div_content_box_main_A">
              <div id="div_content_box_main_A1">
                <span class="content_title_format textShadow">NAME</span></br>
                <span class="content_detail_format textShadow">Please enter a name for your DNA</span>
                <hr>
                <input type="text" name="geneName" id="geneName"  maxlength="30" />
              </div>
              <div id="div_content_box_main_A11" class="content_detail_format textShadow">
              </div>                
              <div id="div_content_box_main_A2">
                <span class="content_title_format textShadow">UPLOAD</span> </br>
                <span class="content_detail_format textShadow">Please upload the DNA sequence in ".txt" format</span>
                <hr>
                <input type="file" name="uploadedFile" id="uploadedFile"/>
              </div>
              <div id="div_content_box_main_A21" class="content_detail_format textShadow">
              </div>
            </div>
              <div id="div_content_box_main_B">
                <div id="div_content_box_main_B1">
                  <span class="content_title_format textShadow">NOTES</span></br>
                  <span class="content_detail_format textShadow">Jot down any notes for yourself</span>
                  <hr>
                  <textarea id="geneNotes" name="geneNotes" maxlength="65535" onkeyup="word_count();"></textarea>
                </div>
                <div id="div_content_box_main_B2_wordcount" class="content_detail_format textShadow" >                  
                </div>
                <div id="div_content_box_main_B2">
                    <input type="submit" value="Submit!" class="submitButton"/>
                </div>
              </div>
          </div>
        </form>
        
      </div>
    </div>

</body>
</html>
