<?php /* edit_proc.php */
require_once "../db/connectdb.php";
require_once "../headers/session.php";

$id_gene = $_POST['id_gene'];
$name_gene = $_POST['name_gene'];
$notes = $_POST['notes'];
$id_user = $_SESSION['id_user'];

// Get the list of genes
$q_genes =
  "SELECT *
   FROM $table_genes
   WHERE name='$name_gene' AND m_id='$id_user'";
$r_genes = mysql_query($q_genes) or die("Fetching member's gene information unsuccessful.");
if(mysql_num_rows($r_genes) > 0) {
  $gene = mysql_fetch_assoc($r_genes);
}

// Check to see if there's a gene with the same name
if($gene['id'] != $id_gene) {
  echo "$name_gene is already in your profile."."</br>";
}
else {
  // Store information into genelisttable
  $_update =
    "UPDATE $table_genes
     SET name_gene = '$name_gene', notes = '$notes', t_modify = 'NOW()'
     WHERE id = '$id_gene'";
  $_update = mysql_query($_update)or die("Updating gene information unsuccessful.");
  
  header("location:../catalog/catalog.php");
}

mysql_close($connection);
ob_end_flush();
?>

