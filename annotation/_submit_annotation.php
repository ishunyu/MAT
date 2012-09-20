<?php /* _submit_annotation.php */
require_once "../headers/session.php";
require_once "../classes/GENE.php";

// Retrieving the gene & annotation
$geneQuery =
  "SELECT geneFormatted, spec
   FROM $table_genes
   WHERE id = '$_POST[id_gene]' AND id_member='$_SESSION[id_user]'";
$geneQuery = mysql_query($geneQuery); $geneQuery = mysql_fetch_assoc($geneQuery);
$gene = $geneQuery['geneFormatted'];
$anno = $geneQuery['spec'];
$anno = json_decode(stripcslashes($anno), true);

if(!$anno) { // If there's no annotation, make sure an array is made
  $anno = array();
  $anno['max_id'] = 0;
}
else {  // Checking for repeats
  foreach($anno as $key => $item) {
    if($key != 'max_id') {
      if($item['name_gene'] == $_POST['name_gene']) {
        die('repeat');  // Stop if there's a repeat.
      }
    }
  }
}

/* Adding the annotation to the array */
$anno[$anno['max_id']] = array(
  "ftr" => mysql_real_escape_string($_POST['feature']),
  "name_gene" => mysql_real_escape_string($_POST['name_gene']),
  "st" => (int)$_POST['start'],
  "end" => (int)$_POST['end']
);

$anno['max_id'] += 1;


// Process the gene according to annotations
$gene = new GENE($gene);
$gene->annotate($anno);
$gene = $gene->get_gene();

$j_anno = json_encode($anno);
$j_anno = mysql_real_escape_string($j_anno);

// Store the annotations
$annoQuery =
  "UPDATE $table_genes
   SET spec = '$j_anno', gene = '$gene', t_modify=NOW()
   WHERE id = '$_POST[id_gene]' AND id_member='$_SESSION[id_user]'";
$annoQuery = mysql_query($annoQuery) or die("Annotations could not be stored");

echo $anno['max_id'] - 1;
?>