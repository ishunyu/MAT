<?php
include "../headers/checkSession.php";

function checkIfGenesExist($my_tableName) {
  $id = $_SESSION['id'];
  
  // Query the gene list
  $geneListQuery =
    "SELECT *
     FROM $my_tableName
     WHERE memberId='$id'";
  $geneListQuery = mysql_query($geneListQuery) or die("Fetching member's gene information unsuccessful.");
  
  // Check to see if there's a gene with the same name
  if(mysql_num_rows($geneListQuery) == 0) {
    echo "Let's get started with a new gene";
  }
  else {

  }
}

?>