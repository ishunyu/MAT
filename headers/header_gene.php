<?php
//Variables for display
$short_gene = '';
$name_gene = 'You don\'t have anything. <a href="../upload/upload.php">Upload something to start!</a>';
$id_gene = '';

// Checks for get variable & its validity
if(isset($_GET['id_gene'])){
  // Check to see if the gene is part of member's gene lists
  $q_check = 
    "SELECT *
     FROM $table_genes
     WHERE id_user = '$_SESSION[id_user]' AND id='$_GET[id_gene]'";
  $r_check = mysql_query($q_check);
  $count = mysql_num_rows($r_check);

  // Checking to see how many results showed up
  if($count == 1) {
    $id_gene = $_GET['id_gene'];
  }
  else {
    header("location:../bad/bad_easter_egg.php");
  }
}

// In case there's no get variable
if($id_gene == '') {
  // Gets the genes according to modify time
  $q_list_genes =
    "SELECT id, name, gene
     FROM $table_genes
     WHERE id_user = '$_SESSION[id_user]'
     ORDER BY t_modify DESC
     LIMIT 1";  // Getting the lastest gene
  $r_list_genes = mysql_query($q_list_genes);
  $num_rows = mysql_num_rows($r_list_genes);  // Get how many rows there are
  
  if($num_rows > 0) {
    $a_list_genes = mysql_fetch_assoc($r_list_genes); // Gets the array structure
    $id_gene = $a_list_genes['id'];
  }
  
}

if($id_gene != "") {
  // Query for the working Gene
  $q_gene = 
    "SELECT name, gene 
     FROM $table_genes
     WHERE id='$id_gene'";
  $r_gene = mysql_query($q_gene);
  $a_gene = mysql_fetch_assoc($r_gene);
  
  $gene = $a_gene['gene'];
  $name_gene = $a_gene['name'];
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


// FUNCTION
function hidden_gene_value($id_gene) {
  echo "<input type=\"hidden\" id=\"id_gene\" value=\"$id_gene\" />";
}

function hidden_num_col($numCol) { // Needs this for spec of GENE class
  echo "<input type=\"hidden\" id=\"numCol\" value=\"$numCol\" />";
}

?>