<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>
  <? require_once "catalog_header.php";
     require_once "../headers/topBar.php" ?>
  <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/topBar.css">
  <link rel="stylesheet" type="text/css" href="../styles/catalog.css">
  
  <link rel="icon" href="../favicon.ico" type="image/x-icon"> 
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  
  <script type="text/javascript" src="../scripts/catalog.js"></script>
  <script>
  function go() {
    var x = document.getElementById("showcase1");
    x.style.height = "500px";
  }

</script>
  
</head>

<body>
<div class="topBarBackground"></div>
  <!-- MAIN-->
  <div id="div_main">
    <!-- TOP BAR-->      
    <? topBar("catalog"); ?> 

    <!-- CONTENT-->
    <div class="generalContentContainer">
      <!-- GENE DISPLAY-->
      <span class="titleFormat textShadow" >Sequences</span>
      <a href="../upload/upload.php">
        <input class="submitButton normalButton" id="" type = "button" value = "Upload" /> </a>
      <table id="catalogTable">
      <!-- LABEL -->
        <? drawRows(); ?>
      </table>
    </div>
  </div>
</body>
</html>