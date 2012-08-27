<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=9"> </meta>
  <link rel="icon" href="favicon.ico" type="image/x-icon"> 
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
  
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/register.css">
  <script type="text/javascript" src="../scripts/register.js"></script>    
</head>
  
<body class="textShadow"> 
  <!-- TITLES -->
  <div class="pageTitle">Register
    <br/>
    <a href="../index.php" id="login" class="smallLink">Click Here to Login</a>
    <hr id="divider" class="">
  </div>
  
  <div id="inputErrorMessage"></div>
  <!-- FORM -->
  <form id="registerForm" name="registerForm"  action="register_proc.php" onsubmit="return checkRegForm()" method="POST">
    <span class="formLabel">First Name</span>
    <input class="inputBoxStyle" id="reg_firstName" type="text" name="firstName" maxlength="255"/>
    <br/><br/>
    
    <span class="formLabel">Last Name</span>
    <input class="inputBoxStyle" id="reg_lastName" type="text" name="lastName" maxlength="225"/>
    <br/><br/>
    
    <span class="formLabel">Password</span>
    <input class="inputBoxStyle" id="reg_password1" type="password" name="password1" maxlength="225"/>
    <br/><br/>
    
    <span class="formLabel">Repeat Password</span>
    <input class="inputBoxStyle" id="reg_password2" type="password" name="password2" maxlength="225"/>
    <br/><br/>
    
    <span class="formLabel">Username</span>
    <td><input class="inputBoxStyle" id="reg_username" type="text" name="username" maxlength="225"/>
    <br/><br/>
    
    <input id="registerSubmitButton" class="submitButton" type="submit" value="Create"/>
  </form>
</body>
</html>



