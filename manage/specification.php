<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>
  <? require_once "specificationInc.php";
     require_once "../headers/geneDisplay.php" ?>
  <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/topBar.css">
  <link rel="stylesheet" type="text/css" href="../styles/specification.css">
  
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
      <span class="titleFormat textShadow" >Annotations</span>
      <br/>
      <span class="detailFormat textShadow" ><? echo $geneTitle;?> <? echo $gene0to30; ?></span>
      <hr>
      
      <!-- LABEL -->
      <div class="specificationLabel">
        <div class="specificationLabelA textShadow">
          Feature
        </div>
        <div class="specificationLabelB textShadow">
          Start
        </div>
        <div class="specificationLabelC textShadow">
          End
        </div>
        <div class="specificationLabelD textShadow">
          Keep
        </div>
      </div>          
      <!-- FORM -->
      <form id="specification_form" method="POST" action="makeGeneAccordingToSpecifications.php">
        <? hidden_value($_SESSION['lastGeneId']); ?>
        <div class="specRow" id="specRow">
          <div class="specRowA1">
            <select name="type1" class="geneType" id="type1" onchange="checkCheckbox(this)">
              <option value="1">m7G Cap</option>
              <option value="1">promoter</option>
              <option value="1">5'URT</option>
              <option value="1">Exon</option>
              <option value="0">Intron</option>
              <option value="1">3'URT</option>
              <option value="1">Poly(A) tail</option>
              <option value="1">other</option>
            </select>
          </div>
          <div class="specRowA2">
            <input type="text" name="start1" class="geneStartAndEndMarker inputBoxStyle" id="start1" onkeydown="return checkInputForNumber(event)"/>
          </div>
          <div class="specRowA3">
            <input type="text" name="end1" class="geneStartAndEndMarker inputBoxStyle" id="end1" onkeydown="return checkInputForNumber(event)"/>
          </div>
          <div class="specRowA4">
            <input type="checkbox" name="keep1" class="geneCheckbox" id="keep1" checked="true"/>
          </div>
        </div>
        <div class="specRowB" id="submit_box">
          <input type="button" value="Add Row" onclick="addRow()" />
          <input type="button" value="Delete Row" onclick="delRow()" />
          <input type="button" value="Clear" onclick="clearRows()" />
          <input type="submit" value="Submit" id="specificationSubmitBotton"/>
        </div>            
      </form>
    </div>
  </div>
</body>
</html>