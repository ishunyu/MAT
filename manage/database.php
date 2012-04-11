<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>
  <? require_once "databaseInc.php";
     ?>
  <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/topBar.css">
  <link rel="stylesheet" type="text/css" href="../styles/database.css">
  
  <link rel="icon" href="../favicon.ico" type="image/x-icon"> 
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  
  <script type="text/javascript" src="../scripts/specifications.js"></script>
</head>

<body>
<div class="topBarBackground"></div>
  <!-- MAIN-->
  <div id="div_main">
    <!-- TOP BAR-->      
    <div class="topBar" >
      <div class="textShadow welcome">Welcome, <? echo $_SESSION['firstName'] ?>!</div>
      <a href="../logout/logout.php" class="textShadow smallLink logout">Logout</a>
      <!-- NAV BAR-->
      <table class="navBar">
        <tr>
          <td class="navBarItem"><a class="navBarItem textShadow" id=""href="../upload/upload.php">Upload</a></td>
          <td class="navBarItem"><a class="navBarItem textShadow" id="" href="../substitution/substitution.php">Substitution</a></td>
          <td class="navBarItem"><a class="navBarItem textShadow" id="" href="../insertion/insertion.php">Insertion</a></td>
          <td class="navBarItem"><a class="navBarItem textShadow" id=""href="../deletion/deletion.php">Deletion</a></td>
          <td class="navBarItem selectedNavBarItem"><a class="navBarItem textShadow" id=""href="../manage/database.php">Database</a></td>
        </tr>
      </table>
    </div>

    <!-- CONTENT-->
    <div class="generalContentContainer roundCorners">
      <!-- GENE DISPLAY-->
      <span class="titleFormat textShadow" >Sequences</span>
      <hr>
      <table>
      <!-- LABEL -->
        <tr>
          <td class="formLabel textShadow centeredTable">Name</td>
        </tr>
        <? drawRows(); ?>
      </table>
    </div>
  </div>
</body>
</html>