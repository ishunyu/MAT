<?
require_once "../headers/session.php";
require_once "../classes/GENE.php";

// Retrieving the gene & annotation
$geneQuery =
  "SELECT geneFormatted, spec
   FROM $gene_table
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";
$geneQuery = mysql_query($geneQuery); $geneQuery = mysql_fetch_assoc($geneQuery);
$gene = $geneQuery['geneFormatted'];
$anno = $geneQuery['spec'];
$anno = json_decode($anno, true);

$anno[$_POST['id']] = array(
                            "ftr" => mysql_real_escape_string($_POST['feature']),
                            "ida" => mysql_real_escape_string($_POST['ida']),
                            "st" => (int)$_POST['start'],
                            "end" => (int)$_POST['end']
                            );


// Process the gene according to annotations
$gene = new gene($gene);
$gene->annotate($anno);
$gene = $gene->getGene();

$j_anno = json_encode($anno);
$j_anno = mysql_real_escape_string($j_anno);
// Store the annotations
$annoQuery =
  "UPDATE $gene_table
   SET spec = '$j_anno', gene = '$gene', modifyTime=NOW()
   WHERE id = '$_POST[geneId]' AND memberId='$_SESSION[id]'";
$annoQuery = mysql_query($annoQuery) or die("Annotation changes could not be stored");

echo "success";
?>