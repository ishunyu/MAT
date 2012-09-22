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
  
  <script type="text/javascript" src="../scripts/main.js"></script>
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
    <? if($id_gene != "") { // Used so that nothing displays if there's no genes exist! ?>
      <!-- GENE DISPLAY-->     
      <span class="titleFormat " ><? echo $name_gene;?></span>
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
  	        <td class="name_annotation">Name</td>
  	        <td class="start">Start</td>
  	        <td class="end">End</td>
          </tr>

          <!-- INPUT BOX -->
          <tr class="" id="input_row">
            <td class="feature" onclick="deactivate_rows_active(null);">
              <!-- FEATURES -->
              <select name="id_feature" class="feature" id="id_feature">
                <? require_once '+option_features.php';?>
              </select></td>
            <td class="name_annotation" onclick="deactivate_rows_active(null);">
              <input type="text" class="name_annotation inputBoxStyle" id="name_annotation" onkeydown="keyboard(event, submit_annotation);" /></td>
            <td class="start" onclick="deactivate_rows_active(null);">
              <input type="text" class="start_end inputBoxStyle" id="start" onkeydown="keyboard(event, submit_annotation);"/></td>
            <td class="end" onclick="deactivate_rows_active(null);">
              <input type="text" class="start_end inputBoxStyle" id="end" onkeydown="keyboard(event, submit_annotation);"/></td>
          </tr>
          <tr class="submitBox" id="submitBox">
            <td colspan="5"> <button type="submit" id="annoSubmitButton" onclick="return submit_annotation();">Submit</button></td>
          </tr>
        </table>
        <table class="annotationTable" id="annotationTable" onblur="deactivate_rows_active(null);">
          <!-- ANNOTATIONS -->                    
          <? require_once '+table_annotation.php';?>
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