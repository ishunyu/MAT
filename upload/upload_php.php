<?php
include "../headers/check_session.php";

function check_num_genes($my_tableName) {
  $memberID = $_SESSION['id'];
  
  // Query the gene list
  $geneListQuery = "SELECT * FROM $my_tableName WHERE MemberID='$memberID'";
  $geneListQuery = mysql_query($geneListQuery);
  // Checks to see if the query was successful
  if(!$geneListQuery) {
    die("Fetching member's gene information unsuccessful.");
  }
  
  //echo var_dump($geneListQuery);
  // Check to see if there's a gene with the same name
  if(mysql_num_rows($geneListQuery) == 0) {
    echo "Let's get started with a new DNA";
  }
  else {
    //echo "Upload a new DNA";
  }
}

?>