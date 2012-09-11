<? require_once '__annotation__.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>  
  <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/top_bar.css">
  <link rel="stylesheet" type="text/css" href="../styles/annotation.css">
  
  <link rel="icon" href="../favicon.ico" type="image/x-icon"> 
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  
  <script type="text/javascript" src="../scripts/annotation.js"></script>
</head>

<body>
<div class="topBarBackground"></div>
  <!-- MAIN-->
  <div id="div_main">    
    <!-- TOP BAR-->      
    <? topBar("annotation") ?>

    <!-- CONTENT-->
    <div class="generalContentContainer">
    <? if($geneId != "") { // Used so that nothing displays if there's no genes exist! ?>
      <!-- GENE DISPLAY-->     
      <span class="titleFormat " ><? echo $geneTitle;?></span>
      <span class="detailFormat" style="float:right"> No error checking yet! Users are responsible for correct input.</span>      
      <hr>
      
      <!-- FORM -->
        <table class="submitTable">
        	<!-- LABEL -->
          <tr>
  	        <td class="feature">
              <a href="../features/features.php">Feature</a>
              <a href="../features/features.php" class="smallLink">(edit)</a>
            </td>
  	        <td class="ida">Name</td>
  	        <td class="start">Start</td>
  	        <td class="end">End</td>
          </tr>

          <!-- INPUT BOX -->
          <tr class="" id="input_row">
            <td class="feature" onclick="deactivate_active_rows(null);">
              <select name="feature" class="feature" id="feature" onchange="checkbox()">
                <? require_once '+features.php';?>
              </select></td>
            <td class="ida" onclick="deactivate_active_rows(null);">
              <input type="text" class="ida inputBoxStyle" id="ida" onkeydown="enter(event);" /></td>
            <td class="start" onclick="deactivate_active_rows(null);">
              <input type="text" class="start_end inputBoxStyle" id="start" onkeydown="enter(event);return input_check(event);"/></td>
            <td class="end" onclick="deactivate_active_rows(null);">
              <input type="text" class="start_end inputBoxStyle" id="end" onkeydown="enter(event); return input_check(event)"/></td>
          </tr>
          <tr class="submitBox" id="submitBox">
            <td colspan="5"> <button type="submit" id="annoSubmitButton" onclick="return submit_annotation();">Submit</button></td>
          </tr>
        </table>
        <? hidden_gene_value($geneId);  hidden_num_col(5); ?>
        <table class="annotationTable" id="annotationTable" onblur="deactivate_active_rows(null);">
          <!-- ANNOTATIONS -->                    
          <? require_once '+annotation_table.php';?>
        </table>
  <? }
     else { ?>
     <!--For when there is no gene -->
      <a class="normalLink" href="../upload/upload.php">
        <span class="titleFormat " >Please upload a DNA Sequence</span> </a>
  <? } ?>
    </div>
  </div>
</body>
</html>
<? mysql_close($connection); ob_end_flush(); ?>