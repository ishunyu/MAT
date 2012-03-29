<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>
  <? require_once "../headers/checkSession.php";
     require_once "../headers/geneDisplay.php" ?>
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  
  <!-- FAVICON -->
  <link rel="icon" href="../favicon.ico" type="image/x-icon"> 
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/topBar.css">
  <link rel="stylesheet" type="text/css" href="../styles/substitution.css">
  
  <!-- JAVASCRIPT -->
  <script type="text/javascript" src="../scripts/substitution.js"></script>
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
          <td class="navBarItem selectedNavBarItem"><a class="navBarItem textShadow" id="" href="../substitution/substitution.php">Substitution</a></td>
          <td class="navBarItem"><a class="navBarItem textShadow" id="" href="../insertion/insertion.php">Insertion</a></td>
          <td class="navBarItem"><a class="navBarItem textShadow" id="" href="../deletion/deletion.php">Deletion</a></td>
          <td class="navBarItem"><a class="navBarItem textShadow" id="" href="../upload/upload.php">Upload</a></td>
          <td class="navBarItem"><a class="navBarItem textShadow" id="" href="../manage/specification.php">Database</a></td>
        </tr>
      </table>
    </div>
    
    <!-- CONTENT-->
    <div class="generalContentContainer roundCorners">
      <!-- GENE DISPLAY-->
      <span class="titleFormat textShadow" ><? echo $geneTitle;?></span>
      <br/>
      <span class="detailFormat textShadow" ><? echo $gene0to30; ?></span>
      <hr>
      
      <div class="ContentContainer">
        <form>
        <span class="formLabel"> Choose Position: </span>
        <input type="text" id="subsitutionPositionInput" name="subsitutionPositionInput" class="inputBoxStyle substitutionInputBox" onkeydown="return checkInputForNumber(event)" onkeyup="showGeneInfoWithOptionalMutation(event)"/>
        &nbsp;&nbsp;&nbsp;
        <input type="button" class="submitButton substitutionSubmitButton" value="A" />
        <input type="button" class="submitButton substitutionSubmitButton" value="T" />
        <input type="button" class="submitButton substitutionSubmitButton" value="G" />
        <input type="button" class="submitButton substitutionSubmitButton" value="C" />
        </form>
      </div>
      <span id="showInfoAboutGeneAtPosition" class="formLabel">&nbsp;hii<div>
    </div>
  </div>
</body>
</html>