<? require_once '__features__.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>  
  <meta http-equiv="X-UA-Compatible" content="IE=9" />

  <!-- STYLESHEETS -->
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/top_bar.css">
  <link rel="stylesheet" type="text/css" href="../styles/features.css">
  
  <!-- FAVICON -->
  <link rel="icon" href="../favicon.ico" type="image/x-icon"> 
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  
  <!-- JAVASCRIPT -->
  <script type="text/javascript" src="../scripts/main.js"></script>
  <script type="text/javascript" src="../scripts/features.js"></script>
</head>

<body>
  <div class="topBarBackground"></div>
  <!-- MAIN-->
  <div id="div_main">    
    <!-- TOP BAR-->      
    <? topBar("features") ?>

    <!-- CONTENT-->
    <div class="generalContentContainer">
      <? if($id_gene != "") { // Used so that nothing displays if there's no genes exist! ?>
      <!-- GENE DISPLAY-->     
      <span class="titleFormat" ><? echo $name_gene;?></span>
      <hr>
      
      <!-- FORM -->
      <table class="submit">
        <!-- LABEL -->
        <tr>
          <td class="">Feature</td>
        </tr>

        <!-- INPUT BOX -->
        <tr class="" id="input_row">
          <td class="feature" colspan="2" onclick="">
            <input type="text" class="name_gene inputBoxStyle" id="feature_user_new" onkeydown="keyboard(event, submit_feature)" /></td>
        </tr>
        <tr class="submitBox" id="submitBox">
          <td colspan="2"> <button type="submit" id="show_featureubmit_btn" onclick="return submit_feature();">Submit</button></td>
        </tr>
      </table>
      <table id = "show_features">
        <tr>
          <? require_once '+table_features.php'; ?>
        </tr>
      </table>
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