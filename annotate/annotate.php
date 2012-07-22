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
        <form id="specification_form" method="POST" action="makeGeneAccordingToSpecifications.php">
      <!-- LABEL -->
      <table class="annotationTable" id="annotationTable">
      	<tr>
	        <td class="textShadow">
	          Feature
	        </td>
	        <td class="textShadow">
	          Id
	        </td>
	        <td class="textShadow">
	          Start
	        </td>
	        <td class="textShadow">
	          End
	        </td>
	        <td class="textShadow">
	          Keep
	        </td>
        </tr>

        
          <? hidden_gene_value($geneId);
             hidden_num_col(5); ?>      
          
          <? require_once "annotations.php";?>        
      
          <tr class="submitBox" id="submit_box">
            <td colspan="5">
            <input type="button" value="Add Row" onclick="addRow()" />
            <input type="button" value="Delete Row" onclick="delRow()" />
            <input type="button" value="Clear" onclick="clearRows()" />
            <input type="submit" value="Submit" id="specificationSubmitBotton"/></td>
          </tr>
        </table>
      </form>    
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