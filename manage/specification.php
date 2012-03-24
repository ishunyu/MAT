<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
  <head>
    <? include "php_specification.php" ?>
    <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
    <link rel="stylesheet" type="text/css" href="../styles/style_main.css">
    <link rel="stylesheet" type="text/css" href="../styles/style_specification.css">
    <script type="text/javascript" src="../scripts/formCheck.js"></script>
  </head>
  
  <body>
    <div id="background_transparent"></div>
      <!-- MAIN-->
      <div id="div_main">
        <!-- TOP BAR-->
        <div id="div_top_bar" class="shadow">
          <div id="div_welcome_message" class="text_shadow">Welcome, <? echo $_SESSION['Firstname']; ?>!</div>
          <div class="text_shadow" id="div_logout"><a href="../logout/logout.php">Logout</a></div>
          <div class="text_shadow" id="div_account"><a href="">Account</a></div>
          <div class="text_shadow" id="div_upload"><a href="../upload/upload_dna.php">Upload</a></div>
          <div class="text_shadow top_bar_options_selected" id="div_manage"><a href="">Manage</a></div>
          <!-- NAV BAR-->
          <div id="div_nav">
            <nav>
              <ul id="nav_bar">
                <li class="nav_bar_items"><a class="nav_bar_items text_shadow" id="" href="../substitution/substitution.php">Substitution</a></li>
                <li class="nav_bar_items"><a class="nav_bar_items text_shadow" id="" href="../insertion/insertion.php">Insertion</a></li>
                <li class="nav_bar_items"><a class="nav_bar_items text_shadow" id=""href="../deletion/deletion.php">Deletion</a></li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- CONTENT-->
        <div id="div_content_box" class="shadow text_shadow ">
          <div id="div_specification_title" >
            <span class="content_title_format"><? echo $DNATitle;?></span>
            </br>
            <span class="content_detail_format"><? echo $showDNA; ?></span>
          </div>

          <hr>
          <div class="div_content_box_specification_A">
            
          </div>
          <div class="div_content_box_specification_B">
            
          </div>
        </div>
      </div>

  </body>
</html>