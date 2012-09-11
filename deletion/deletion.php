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
  <script type="text/javascript" src="../scripts/deletion.js"></script>
</head>

<body>
  <div class="topBarBackground"></div>
  <!-- MAIN-->
  <div id="div_main" >
  <? topBar("mutation"); ?> 
    
    <!-- CONTENT-->
    <div class="generalContentContainer">
      <!-- GENE DISPLAY-->
      <? if($geneId != "") { // Used so that nothing displays if there's no genes exist! ?>       
        <span class="titleFormat" ><? echo $geneTitle;?></span>
        <? mutation_navbar('deletion'); ?>
        <hr>
        
        <div class="ContentContainer">
          <table>
            <tr>
              <td><span class="formLabel">First deleted base:</span></td>
              <td><input type="text" id="start_index" class="inputBoxStyle text_small" onkeyup="deletion_info()"/></td>
            </tr>
            <tr>
              <td><span class="formLabel">Last deleted base:</span></td>
              <td><input type="text" id="end_index" class="inputBoxStyle text_small" onkeyup="deletion_info()"/><br></td>
            </tr>
            <tr>
              <td>
              </td>
              <td><input type="button" class="" value="Submit" onclick="deletion_info()"></input></td>
            </tr>
          </table>
        </div>
        <table id="deletion_info">

        </table>
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