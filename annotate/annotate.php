<? require_once "annotate_header.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>  
  <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/topBar.css">
  <link rel="stylesheet" type="text/css" href="../styles/annotate.css">
  
  <link rel="icon" href="../favicon.ico" type="image/x-icon"> 
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  
  <script type="text/javascript" src="../scripts/annotation.js"></script>
</head>

<body>
<div class="topBarBackground"></div>
  <!-- MAIN-->
  <div id="div_main">    
    <!-- TOP BAR-->      
    <? topBar("annotate") ?>

    <!-- CONTENT-->
    <div class="generalContentContainer">
    <? if($geneId != "") { // Used so that nothing displays if there's no genes exist! ?>
      <!-- GENE DISPLAY-->     
      <span class="titleFormat textShadow" ><? echo $geneTitle;?></span>
      <span class="detailFormat" style="float:right"> No error checking yet! Users are responsible for correct input.</span>      
      <hr>
      
      <!-- FORM -->
        <table class="submitTable">
        	<!-- LABEL -->
          <tr>
  	        <td class="textShadow">Feature</td>
  	        <td class="textShadow">Id</td>
  	        <td class="textShadow">Start</td>
  	        <td class="textShadow">End</td>
  	        <td class="textShadow">Keep</td>
          </tr>

          <!-- INPUT BOX -->
          <tr class="specRow" id="specRow">
            <td class="feature">
              <select name="feature" class="geneFeature" id="feature" onchange="checkCheckbox(this)">
                <option value="2">m7G Cap</option>
                <option value="3">promoter</option>
                <option value="4">5'URT</option>
                <option value="1">Exon</option>
                <option value="0">Intron</option>
                <option value="5">3'URT</option>
                <option value="6">Poly(A) tail</option>
                <option value="99">other</option>
              </select></td>
            <td class="ida">   <input type="text" class="idInputBox inputBoxStyle" id="ida" /></td>
            <td class="start"><input type="text" class="geneStartAndEndMarker inputBoxStyle" id="start" onkeydown="return checkInputForNumber(event)"/></td>
            <td class="end">  <input type="text" class="geneStartAndEndMarker inputBoxStyle" id="end" onkeydown="return checkInputForNumber(event)"/></td>
            <td class="keep"> <input type="checkbox" class="geneCheckbox" id="keep" checked="true"/></td>
          </tr>
          <tr class="submitBox" id="submitBox">
            <td colspan="5"> <button type="submit" id="annoSubmitButton" onclick="return submitAnnotation();">Submit</button></td>
          </tr>
        </table>

        <table class="annotationTable" id="annotationTable">
          <!-- FEATURES -->
          <? hidden_gene_value($geneId);  hidden_num_col(5); ?>          
          <? require_once "anno_table.php";?>
        </table>
  <? }
     else { ?>
     <!--For when there is no gene -->
      <a class="normalLink" href="../upload/upload.php">
        <span class="titleFormat textShadow" >Please upload a DNA Sequence</span> </a>
  <? } ?>
    </div>
  </div>
</body>
</html>