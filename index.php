<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 

<?php
include "dbConfig.php";
include "login.php";
//include "register.php";

mysql_close($connection);
ob_end_flush();
?>

<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9"> </meta>
    <link rel="stylesheet" type="text/css" href="styles/style_index.css">
    <script type="text/javascript">
      function checkRegForm() {      
        var firstName = document.getElementById("reg_firstName").value;
        var lastName = document.getElementById("reg_lastName").value; 
        var password1 = document.getElementById("reg_password1").value;
        var password2 = document.getElementById("reg_password2").value;
        var accountname = document.getElementById("reg_accountName").value;
        var returnValue = false;
        
        // Check to see if all fields are filled
        if(!(firstName.match(/\S/) &&
        lastName.match(/\S/) &&
        password1.match(/\S/) &&
        password2.match(/\S/) &&
        accountname.match(/\S/))) {
          showError("Please fill in all forms please!");       
          return false;
        }
        
        if(/\W/g.test(firstName) ||
        /\W/g.test(lastName) ||
        /\W/g.test(password1) ||
        /\W/g.test(password2) ||
        /\W/g.test(accountname)
        ) {
          showError("Form fields cannot contain illegal characters!");     
          return false;
        }
        
        // Check to see if pass words match
        if(password1 != password2) {
          showError("Passwords don't match!");          
          return false;
        }
        
        
        if(password1 == accountname) {
          showError("Password is same as Account Name!");
          return false;       
        }
        
        if(password1.search(firstName) || password1.search(lastName)) {
          showError("Password contains First/Last name!");
          return false;
        }
        
        document.getElementById("submitButton").value="YES!";
        return returnValue;
      }
      
      function showError(s) {
        document.getElementById("inputErrorMessage").innerHTML = s;
        document.getElementById("inputErrorMessage").style.color = "orange";
        document.getElementById("inputErrorMessage").style.fontWeight = "bold";
        document.getElementById("inputErrorMessage").style.fontSize = "14px";
      }
    </script>
  </head>
  
  <body>
    
    <table class="main">
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
              <td class="loginTitle"><center></br><u>Login</u></center></td>
              <td class="registerTitle"><center></br><u>Register</u></center></td>
            </tr>
            <tr>
              <td class="loginBox">
                <table>
                  <tr>
                    <td class="loginBoxSpacer"></td>
                    <td>
                      <form name="input_login" action="index.php" method="POST" class="loginForm">
                        <table>
                          <tr>
                            <th colspan="2">&nbsp
                          <?php
                            if(!$loginSuccess) {
                              echo "<span class=\"tryAgain\">Please try again~ :D</span>";
                            }
                          ?>
                            </th>
                          </tr>
                          <tr>
                            <td class="rightAlign"><span class="regularText">Account Name:</span></td>
                            <td class="leftAlign"><input type="text" name="accountName"></br></td>
                          </tr>
                          <tr>
                            <td class="rightAlign"><span class="regularText">Password:</span></td>
                            <td class="leftAlign"><input type="password" name="password"></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td><input type="submit" value="Start" /></td>
                          </tr>
                        </table>
                      </form>
                    </td>
                    <td></td>
                  </tr>
                </table>
              </td>
              <td class="registerBox">
                <table>
                  <tr>
                    <td class="registerBoxSpacer"></td>
                    <td>
                      <form name="input_register" method="POST" class="registerForm" onsubmit="return checkRegForm()">
                        <table class="table_register">
                          <tr>
                            <th colspan="2" class="tryAgainMessageBox"><span id="inputErrorMessage" class="tryAgain">&nbsp
                              <?php
                                //if(!$registerSuccess) {
                                  //echo "Please Choose Another Account Name!";
                                //}
                              ?>
                              </span>
                            </th>
                          </tr>
                          <tr>
                            <td class="rightAlign"><span class="regularText">First Name:</span></td>
                            <td><input id="reg_firstName" type="text" name="firstName"></td>
                          </tr>
                          <tr>
                            <td class="rightAlign"><span class="regularText">Last Name:</span></td>
                            <td><input id="reg_lastName" type="text" name="lastName"></td>
                          </tr>
                          <tr>
                            <td class="rightAlign"><span class="regularText">Password:</span></td>
                            <td><input id="reg_password1" type="password" name="password1"></td>
                          </tr>
                          <tr>
                            <td class="rightAlign"><span class="regularText">Repeat Password:</span></td>
                            <td><input id="reg_password2" type="password" name="password2"></td>
                          </tr>
                          <tr>
                            <td class="rightAlign"><span class="regularText">Account Name:</span></td>
                            <td><input id="reg_accountName" type="text" name="accountName"></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td><input id="submitButton" type="submit" value="Create"/></td>
                          </tr>
                        </table>
                      </form>
                    </td>
                    <td></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table> 
        </td>
      </tr> 
      <tr>
        <td class="loginMessageBox">
          Copyright &copy; Shun Yu 2012-2012
        </td>
      </tr>
    </table>
  </body>
</html>



