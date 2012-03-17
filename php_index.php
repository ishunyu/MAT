<?php
  include "db_config.php";
  include "login.php";
  include "register.php";
  
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