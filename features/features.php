<? require_once '__features__.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>  
  <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/top_bar.css">
  <link rel="stylesheet" type="text/css" href="../styles/annotate.css">
  
  <link rel="icon" href="../favicon.ico" type="image/x-icon"> 
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  
  <script type="text/javascript" src="../scripts/features.js"></script>
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
      <hr>
      
      <!-- FORM -->
      <table class="submitTable">
        <!-- LABEL -->
        <tr>
          <td class="textShadow">Feature
          </td>
        </tr>

        <!-- INPUT BOX -->
        <tr class="" id="input_row">
          <td class="feature" colspan="2" onclick="<!-- deactivate_active_rows(null); -->">
            <input type="text" class="ida inputBoxStyle" id="feature" onkeydown="<!-- enter(event); -->" /></td>
        </tr>
        <tr class="submitBox" id="submitBox">
          <td colspan="2"> <button type="submit" id="feature_submit_btn" onclick="return submit_feature();">Submit</button></td>
        </tr>
        <? require_once '+table_features.php'; ?>
      </table>
      <? hidden_gene_value($geneId);  hidden_num_col(5); ?>
      <? }else { ?>
      <!--For when there is no gene -->
      <a class="normalLink" href="../upload/upload.php">
        <span class="titleFormat textShadow" >Please upload a DNA Sequence</span></a>
        <? } ?>
    </div>
  </div>
</body>
</html>
<? mysql_close($connection); ob_end_flush(); ?>