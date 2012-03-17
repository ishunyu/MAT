<?php
  include "dbConfig.php";
  include "login.php";
  include "register.php";
  
  function showLoginMessage($input) {
    if(!$loginSuccess) {
      echo "<span class=\"tryAgain\">Please try again~ :D</span>";
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