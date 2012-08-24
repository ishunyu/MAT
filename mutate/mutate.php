<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>
  <? require_once "../headers/session.php";
     require_once "../headers/show_gene.php";
     require_once "../headers/top_bar.php" ?>
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  
  <!-- FAVICON -->
  <link rel="icon" href="../favicon.ico" type="image/x-icon"> 
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/top_bar.css">
  <link rel="stylesheet" type="text/css" href="../styles/mutate.css">
  <link rel="stylesheet" type="text/css" href="../styles/substitution.css">
  
  <!-- JAVASCRIPT -->
  <script type="text/javascript" src="../scripts/mutate.js"></script>
</head>

<body onkeydown="return checkInputForNumber(event)">
  <div class="topBarBackground"></div>
  <!-- MAIN-->
  <div id="div_main" >
  <? topBar("mutate"); ?> 
    
    <!-- CONTENT-->
    <div class="generalContentContainer">
      <!-- GENE DISPLAY-->
      <? if($geneId != "") { // Used so that nothing displays if there's no genes exist! ?>
        <div class="mutate_navBar">          
          <input class="submitButton mutateButton mutateButtonActive" id="Substitution" type = "button" value = "Substitution" />
          <input class="submitButton mutateButton" id="Insertion" type = "button" value = "Insertion" />
          <input class="submitButton mutateButton" id="Deletion" type = "button" value = "Deletion" />
          <input type="hidden" id="mutateState" value="substitution" />
        </div>
        </br>        
        <span class="titleFormat textShadow" ><? echo $geneTitle;?></span>
        <hr>
        
        <div class="ContentContainer">
          <form>
            <span class="formLabel"> Choose Base: </span>
            <input type="text" id="subsitutionPositionInput" name="subsitutionPositionInput" class="inputBoxStyle substitutionInputBox" onkeyup="showGeneInfoWithOptionalMutation(event.keyCode)"/>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" class="submitButton substitutionSubmitButton" value="A" onclick="showGeneInfoWithOptionalMutation(this.value.charCodeAt(0))"/>
            <input type="button" class="submitButton substitutionSubmitButton" value="T" onclick="showGeneInfoWithOptionalMutation(this.value.charCodeAt(0))"/>
            <input type="button" class="submitButton substitutionSubmitButton" value="G" onclick="showGeneInfoWithOptionalMutation(this.value.charCodeAt(0))"/>
            <input type="button" class="submitButton substitutionSubmitButton" value="C" onclick="showGeneInfoWithOptionalMutation(this.value.charCodeAt(0))"/> 
          </form>
        </div>
        <span id="showInfoAboutGeneAtPosition" class="formLabel">
            Base: <br/>
            Codon Position: <br/>
            Old codon: <br/>
            New codon: <br/><hr>
            Nucleic acid level: <br/>
            Protein level: <br/>
        <span>
      <? }
         else { ?>
          <a class="normalLink" href="../upload/upload.php">
            <span class="titleFormat textShadow" >Please upload a DNA Sequence</span> </a>
      <? } ?>
    </div>
  </div>
</body>
</html>