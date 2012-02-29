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
                <center></br><u>Login</u></center>
              </td>
              <td class="registerTitle">
                <center></br><u>Register</u></center>
              </td>
            </tr>
            <tr>
              <td class="loginBox">
                <form name="input_login" action="login.php" method="POST" class="loginForm">
                  <table>
                    <tr>
                      <td>
                        <span class="regularText">Account name:</span>
                      </td>
                      <td>
                        <input type="text" name="accountName"> </br>
                      </td>
                    <tr>
                    <tr>
                      <td>
                        <span class="regularText">Password: </span>
                      </td>
                      <td>
                        <input type="password" name="password">
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>
                        <input type="submit" value="Start" />
                      </td>
                    </tr>
                  </table>
                </form>
              </td>
              <td class="registerBox">
                <form name="input_register" action="register.php" method="POST" class="registerForm">
                  <table class="table_register">
                    <tr>
                      <td class="rightAlign">
                        <span class="regularText">First Name:</span>
                      </td>
                      <td>
                        <input type="text" name="firstName">
                      </td>
                    </tr>
                    <tr>
                      <td class="rightAlign">
                        <span class="regularText">Last Name:</span>
                      </td>
                      <td>
                        <input type="text" name="lastName">
                      </td>
                    </tr>
                    <tr>
                      <td class="rightAlign">
                        <span class="regularText">Password:</span>
                      </td>
                      <td>
                        <input type="password" name="password1">
                      </td>
                    </tr>
                    <tr>
                      <td class="rightAlign">
                        <span class="regularText">Repeat Password:</span>
                      </td>
                      <td>
                        <input type="password" name="password2">              
                      </td>
                    </tr>
                    <tr>
                      <td> </td>
                      <td>
                        <input type="submit" value="Create" />
                      </td>
                    </tr>
                  </table>
                </form>
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



