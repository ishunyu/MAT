<?php
session_start();
if(!isset($_SESSION['accountName'])) {
  header("location:index.php");
}
?>