<?
require_once "../headers/session.php";

//Variables for display
$name_gene = '';
$id_gene = '';
$notes = '';

// Checks for get variable & its validity
if(isset($_GET['id_gene'])){
  // Check to see if the gene is part of member's gene lists
  $checkQuery = 
    "SELECT *
     FROM $table_genes
     WHERE id_member = '$_SESSION[id_user]' AND id='$_GET[id_gene]'";
  $checkQuery = mysql_query($checkQuery);
  $num_rows_checkQuery = mysql_num_rows($checkQuery);

  // Checking to see how many results showed up
  if($num_rows_checkQuery != 0) {
    $id_gene = $_GET['id_gene'];
  }
  else {
    header("location:../headers/easter_egg.php");
  }
}

if($id_gene != '') {
  // Query for the working Gene
  $q_gene = 
    "SELECT name, notes
     FROM $table_genes
     WHERE id='$id_gene'";
  $r_gene = mysql_query($q_gene);
  $gene = mysql_fetch_assoc($r_gene);

  $name_gene = $gene['name'];
  $notes = $gene['notes'];
}
else {  // If there's no get variable
  header("location:../catalog/catalog.php");
}

// FUNCTION
function hidden_gene_value($id_gene) {
  echo '<input type="hidden" id="id_gene" name="id_gene" value="'.$id_gene.'" />';
}
?>