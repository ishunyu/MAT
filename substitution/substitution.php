<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>
  <? require_once "../headers/checkSession.php";
     require_once "../headers/geneDisplay.php";
     require_once "../headers/topBar.php" ?>
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
  <div id="div_main" >
  <? topBar("substitution"); ?> 
    
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
        <input type="text" id="subsitutionPositionInput" name="subsitutionPositionInput" class="inputBoxStyle substitutionInputBox" onkeydown="return checkInputForNumber(event)" onkeyup="showGeneInfoWithOptionalMutation(event.keyCode)"/>
        &nbsp;&nbsp;&nbsp;
        <input type="button" class="submitButton substitutionSubmitButton" value="A" onclick="showGeneInfoWithOptionalMutation(this.value.charCodeAt(0))"/>
        <input type="button" class="submitButton substitutionSubmitButton" value="T" onclick="showGeneInfoWithOptionalMutation(this.value.charCodeAt(0))"/>
        <input type="button" class="submitButton substitutionSubmitButton" value="G" onclick="showGeneInfoWithOptionalMutation(this.value.charCodeAt(0))"/>
        <input type="button" class="submitButton substitutionSubmitButton" value="C" onclick="showGeneInfoWithOptionalMutation(this.value.charCodeAt(0))"/>
        </form>
      </div>
      <span id="showInfoAboutGeneAtPosition" class="formLabel">
          Position: <br/>
          Old codon: <br/>
          New codon: <br/><hr>
          Nucleic acid level: <br/>
          Protein level: <br/>
      <span>
    </div>
  </div>
</body>
</html>