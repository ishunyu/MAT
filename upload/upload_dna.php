<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
  <head>
    <? include "php_upload_dna.php" ?>
    <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
    <link rel="stylesheet" type="text/css" href="../styles/style_main.css">
    <script type="text/javascript" src="../scripts/formCheck.js"></script>
  </head>
  
  <body>
    <div id="background_transparent"></div>
      <!-- MAIN-->
      <div id="div_main">
        <!-- TOP BAR-->
        <div id="div_top_bar" class="shadow">
          <div id="div_welcome_message" class="text_shadow">Welcome, <? echo $_SESSION['Firstname'] ?>!</div>
          <div class="text_shadow" id="div_logout"><a href="../logout/logout.php">Logout</a></div>
          <div class="text_shadow" id="div_account"><a href="">Account</a></div>
          <div class="text_shadow top_bar_options_selected" id="div_upload"><a href="">Upload</a></div>
          <div class="text_shadow" id="div_manage"><a href="../manage/manage.php">Manage</a></div>
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
        <div id="div_content_box_upload" class="shadow">
          <div id="div_introduction_box" class="text_shadow">
          <? check_num_genes($tableName_genelisttable); ?>
          </div>
          <form enctype="multipart/form-data" method="POST" action="uploader.php" onsubmit="return check_upload();" id="upload_dna_form">
            <div id="div_content_box_main">
              <div id="div_content_box_main_A">
                <div id="div_content_box_main_A1">
                  <span class="content_title_format text_shadow">NAME</span></br>
                  <span class="content_detail_format text_shadow">Please enter a name for your DNA</span>
                  <hr>
                  <input type="text" name="nameOfDNA" id="dna_name"  maxlength="30" />
                </div>
                <div id="div_content_box_main_A11" class="content_detail_format text_shadow">
                </div>                
                <div id="div_content_box_main_A2">
                  <span class="content_title_format text_shadow">UPLOAD</span> </br>
                  <span class="content_detail_format text_shadow">Please upload the DNA sequence in ".txt" format</span>
                  <hr>
                  <input type="file" name="uploadedFile" id="upload_file_button"/>
                </div>
                <div id="div_content_box_main_A21" class="content_detail_format text_shadow">
                </div>
              </div>
                <div id="div_content_box_main_B">
                  <div id="div_content_box_main_B1">
                    <span class="content_title_format text_shadow">NOTES</span></br>
                    <span class="content_detail_format text_shadow">Jot down any notes for yourself</span>
                    <hr>
                    <textarea id="dna_notes" name="dnaNotes" maxlength="65535" onkeyup="word_count();"></textarea>
                  </div>
                  <div id="div_content_box_main_B2_wordcount" class="content_detail_format text_shadow" >                  
                  </div>
                  <div id="div_content_box_main_B2">
                      <input type="submit" value="Submit!" id="submit_button"/>
                  </div>
                </div>
            </div>
          </form>
          
        </div>
      </div>

  </body>
</html>
