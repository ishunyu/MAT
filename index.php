<?php

?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
  </head>
  
  <body>
    <table align="center" class="main">
      <tr>
        <td class="welcomeMessageBox">
          </br>
          <center>
            <span class="welcomeMessage">WELCOME TO MAT</span>
          </center>
        </td>
      </tr>
      <tr>
        <td>
          <table class="registerAndLogin">
            <tr>
              <td class="loginTitle">
                <center></br>Login</center>
              </td>
              <td class="registerTitle">
                <center></br>Register</center>
              </td>
            </tr>
            <tr>
              <td class="loginBox">
                
              </td>
              <td>
              </td>
            </tr>
          </table> 
        </td>
      </tr> 
      <tr>
        <td class="loginMessageBox">
          <?php
            if(session_id() == "") {
              echo "User is NOT logged in.";
            }
            else {
              echo session_id()." is logged in.";
            }
          ?>
        </td>
      </tr>
    </table>
  </body>
</html>



