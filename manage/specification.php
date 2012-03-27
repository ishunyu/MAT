<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
  <head>
    <? include "specification_php.php" ?>
    <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
    <link rel="stylesheet" type="text/css" href="../styles/style_main.css">
    <link rel="stylesheet" type="text/css" href="../styles/style_specification.css">
    <script type="text/javascript" src="../scripts/functional.js"></script>
  </head>
  
  <body>
    <div id="background_transparent"></div>
      <!-- MAIN-->
      <div id="div_main">
        <!-- TOP BAR-->
        <div id="div_top_bar" class="shadow">
          <div id="div_welcome_message" class="text_shadow">Welcome, <? echo $_SESSION['userName']; ?>!</div>
          <div class="text_shadow" id="div_logout"><a href="../logout/logout.php">Logout</a></div>
          <div class="text_shadow" id="div_account"><a href="">Account</a></div>
          <div class="text_shadow" id="div_upload"><a href="../upload/upload.php">Upload</a></div>
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
        <div id="div_content_box_specification" class="shadow text_shadow ">
          <div id="div_specification_title" >
            <span class="content_title_format"><? echo $dnaTitle;?></span>
            </br>
            <span class="content_detail_format"><? echo $dna0to30; ?></span>
          </div>

          <hr>
          <div id="div_content_box_specification_top">
            <div id="div_content_box_specification_top1">
              Type
            </div>
            <div id="div_content_box_specification_top2">
              Start
            </div>
            <div id="div_content_box_specification_top3">
              End
            </div>
          </div>          
          <form id="specification_form" method="POST" action="specification_commit_php.php">
            <? hidden_value($_SESSION['lastDnaId']); ?>
            <div class="div_content_box_specification_row">
              <div class="div_content_box_specification_A1">
                <select name="type1" class="dna_type" id="type1">
                  <option value="promoter">promoter</option>
                  <option value="5URT">5'URT</option>
                  <option value="exon">Exon</option>
                  <option value="intron">Intron</option>
                  <option value="3URT">3URT</option>
                  <option value="other">other</option>
                </select>
              </div>
              <div class="div_content_box_specification_A2">
                <input type="text" name="start1" class="dna_start_end" id="start1"/>
              </div>
              <div class="div_content_box_specification_A3">
                <input type="text" name="end1" class="dna_start_end" id="end1"/>
              </div>
            </div>
            <div class="div_content_box_specification_B" id="submit_box">
              <input type="button" value="Add Row" onclick="addRow()" />
              <input type="button" value="Delete Row" onclick="delRow()" />
              <input type="submit" value="Submit" id="submit_button_specification"/>
            </div>            
          </form>
        </div>
      </div>

  </body>
</html>