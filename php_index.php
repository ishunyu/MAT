<?php
  include "headers/db_config.php";
  include "login/login.php";
  include "register/register.php";
  
  function showLoginMessage($input) {
    if(!$input) {
      echo "<span class=\"tryAgain\">Please try again! :)</span>";
    }
  }
  
  function showRegisterMessage($input) {
   if(!$input) {
    echo "Account Name already registered!";
    }
  }

  mysql_close($connection);
  ob_end_flush();
?>