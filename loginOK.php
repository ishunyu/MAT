<?php
session_start();
if($_SESSION['accountName'] && $_SESSION['password']) {
  echo "DAMNNNNN SEXY";
  header("location:uploadDNA.php");
}
?>