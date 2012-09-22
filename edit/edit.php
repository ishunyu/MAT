<? 
require_once "__edit__.php";
require_once "../headers/navbar_top.php"
?>

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
  <link rel="stylesheet" type="text/css" href="../styles/edit.css">
  
  <!-- JAVASCRIPTS -->
  <script type="text/javascript" src="../scripts/main.js"></script>
  <script type="text/javascript" src="../scripts/edit.js"></script>
</head>

<body>
    <div class="topBarBackground"></div>
    <!-- MAIN-->
    <div id="div_main">
      <? topBar("catalog"); ?> 
      <!-- CONTENT-->
      <div class="generalContentContainer">
      	<!-- EDIT FORM -->
        <form id="geneEditForm" enctype="multipart/form-data" method="POST" action="process_edit.php" onsubmit="return check_edit();">
          <? echo hidden_gene_value($id_gene); ?>
          <!-- SEQUENCE IDENTIFIER -->
          <span class="titleFormat textShadow">Sequence Identifier</span><br/>
          <span class="detailFormat textShadow">Please enter a name, number, ??? number or other ID for your sequence. This is for your reference only.</span><hr>          
          <input type="text" name="name_gene" id="name_gene"  class="inputBoxStyle" maxlength="30"
          		 value="<? echo $name_gene; ?>"/>            
          <span id="name_geneWarning" class="warningFormat textShadow"></span>
          <br/><br/>
          <!-- NOTES -->
          <span class="titleFormat textShadow">Notes</span><br/>
          <span class="detailFormat textShadow">Jot down any notes for yourself</span>
          <hr>
          <textarea id="notes" name="notes" maxlength="65535" onkeyup="word_count_popup(event);"><? echo $notes; ?></textarea>
          <br/>
          <!-- SUBMIT BUTTON -->
          <input type="submit" value="Save" id="uploadSubmitButton" class="submitButton"/>         
        </form>
        
      </div>
    </div>

</body>
</html>

<? mysql_close($connection); ob_end_flush(); ?>
