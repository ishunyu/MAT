<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
  <head>
    <? include "check_session.php"; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
    <link rel="stylesheet" type="text/css" href="styles/style_main.css">
  </head>
  
  <body>
    <div id="background_transparent"></div>
      <!-- MAIN-->
      <div id="div_main">
        <!-- TOP BAR-->
        <div id="div_top_bar">
          <div id="div_welcome_message">Welcome, <? echo $row['Firstname']; ?>!</div>
          <div class="" id="div_logout"><a href="logout.php">Logout</a></div>
          <div class="" id="div_account"><a href="">Account</a></div>
          <div class="" id="div_upload"><a href="upload_dna.php">Upload</a></div>
          <div class="" id="div_choose"><a href="">Choose</a></div>
          <!-- NAV BAR-->
          <div id="div_nav">
            <nav>
              <ul id="nav_bar">
                <li class="nav_bar_items"><a class="nav_bar_items" id="selected" href="substitution.php">Substitution</a></li>
                <li class="nav_bar_items"><a class="nav_bar_items" id="" href="insertion.php">Insertion</a></li>
                <li class="nav_bar_items"><a class="nav_bar_items" id=""href="deletion.php">Deletion</a></li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- CONTENT-->
        <div id="div_content_box">
          <div id="div_content_box_main">
            s
          </div>
        </div>
      </div>

  </body>
</html>