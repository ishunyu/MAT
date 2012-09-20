<?php
//Variables for display
$short_gene = '';
$title_gene = 'You don\'t have anything. <a href="../upload/upload.php">Upload something to start!</a>';
$id_gene = '';

// Checks for get variable & its validity
if(isset($_GET['id_gene'])){
  // Check to see if the gene is part of member's gene lists
  $q_check = 
    "SELECT *
     FROM $table_genes
     WHERE id_member = '$_SESSION[id_user]' AND id='$_GET[id_gene]'";
  $r_check = mysql_query($q_check);
  $count = mysql_num_rows($r_check);

  // Checking to see how many results showed up
  if($count == 1) {
    $id_gene = $_GET['id_gene'];
  }
  else {
    header("location:../headers/easter_egg.php");
  }
}

// In case there's no get variable
if($id_gene == '') {
  // Gets the genes according to modify time
  $dnaListQuery =
    "SELECT id, name, gene
     FROM $table_genes
     WHERE id_member = '$_SESSION[id_user]'
     ORDER BY t_modify DESC
     LIMIT 1";  // Getting the lastest gene
  $dnaListQuery = mysql_query($dnaListQuery);
  $num_rows = mysql_num_rows($dnaListQuery);  // Get how many rows there are
  
  if($num_rows > 0) {
    $dnaListQuery = mysql_fetch_assoc($dnaListQuery); // Gets the array structure
    $id_gene = $dnaListQuery['id'];
  }
  
}

if($id_gene != "") {
  // Query for the working Gene
  $geneQuery = 
    "SELECT name, gene 
     FROM $table_genes
     WHERE id='$id_gene'";
  $geneQuery = mysql_query($geneQuery);
  $geneQuery = mysql_fetch_assoc($geneQuery);
  
  $gene = $geneQuery['gene'];
  $title_gene = $geneQuery['name'];
  if(strlen($gene) > 30) {
    $short_gene = substr($gene, 0, 30);
    $short_gene = $short_gene."...";
  }
  else {
    $short_gene = $gene;
  }
  $short_gene = "(".$short_gene.")";

  $_SESSION['id_gene'] = $id_gene;
}

$updateQuery =
  "UPDATE $table_genes
   SET t_modify=NOW()
   WHERE id='$id_gene'";
$updateQuery = mysql_query($updateQuery);

// FUNCTION
function hidden_gene_value($id_gene) {
  echo "<input type=\"hidden\" id=\"id_gene\" value=\"$id_gene\" />";
}

function hidden_num_col($numCol) { // Needs this for spec of GENE class
  echo "<input type=\"hidden\" id=\"numCol\" value=\"$numCol\" />";
}

?>