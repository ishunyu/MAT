<? require_once './__deletion__.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  
  <!-- FAVICON -->
  <link rel="icon" href="../favicon.ico" type="image/x-icon"> 
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/top_bar.css">
  <link rel="stylesheet" type="text/css" href="../styles/substitution.css">
  
  <!-- JAVASCRIPT -->
  <script type="text/javascript" src="../scripts/substitution.js"></script>
</head>

<body onkeydown="return checkInputForNumber(event)">
  <div class="topBarBackground"></div>
  <!-- MAIN-->
  <div id="div_main" >
  <? topBar("mutation"); ?> 
    
    <!-- CONTENT-->
    <div class="generalContentContainer">
      <!-- GENE DISPLAY-->
      <? if($geneId != "") { // Used so that nothing displays if there's no genes exist! ?>
        <? mutation_navbar('deletion'); ?>
        </br>        
        <span class="titleFormat textShadow" ><? echo $geneTitle;?></span>
        <hr>
        
        <div class="ContentContainer">
          <input type="text" id="start_index" />
          <input type="text" id="end_index" />
          <button>Submit</button> 
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
<? mysql_close($connection); ob_end_flush(); ?>