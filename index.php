<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.ddiv"> 
<html>
<head>
  <? require_once "index_header.php"; ?>
  <meta http-equiv="X-UA-Compatible" content="IE=9"> </meta>

  <link rel="icon" href="favicon.ico" type="image/x-icon"> 
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link rel="stylesheet" type="text/css" href="styles/index.css">
  <link rel="stylesheet" type="text/css" href="styles/main.css">

  <script type="text/javascript" src="scripts/formChecking.js"></script>
  <script type="text/javascript" src="scripts/index.js"></script>
</head>
  
<body class="textShadow" onload="indexPageLoads();">
  <!-- TITLE -->
  <div class="pageTitle">Mutation Analysis Tool<hr id="divider" class=""></div>
  
  <!-- FORM -->
  <form name="inputLogin" action="login/login.php" method="POST" id="loginForm">
    <span class="formLabel">Username</span>
    <input class="inputBoxStyle" id="username" type="text" name="username" onkeydown="clearIndexPageInputs()"/>
    <br/><br/>
    
    <span class="formLabel">Password</span>
    <input class="inputBoxStyle" id="password" type="password" name="password" onkeydown="clearIndexPageInputs()"/>
    <br/><br/>
    
    <input class="submitButton" id="indexSubmitButton" type="submit" value="Start" />
    </br>
    
    <a href="register/register.php" id="notRegistered" class="smallLink">Not Registered?</a>
  </form>
</body>
</html>



