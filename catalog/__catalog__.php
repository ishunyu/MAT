<?
require_once '../headers/session.php';
require_once "../headers/top_bar.php";

function td($string, $class) {
  return "<td class=\"$class\">$string</td>";
}

function a($string, $link) {
  return "<a href=\"$link\">$string</a>";
}

function drawRows() {
  include "../headers/variables.php";
  
  $geneQ =
    "SELECT id, name
     FROM $table_genes
     WHERE m_id = $_SESSION[id_user]";
  $geneQ = mysql_query($geneQ);    
  
  while($item = mysql_fetch_assoc($geneQ)) {
  echo '<tr id="'.strval($item['id']).'">';
	echo td($item['name'],
          'formLabel labelColumn');
	echo td('<b>'.a('Mutate','../deletion/deletion.php?id_gene='.strval($item['id']))
          .'&nbsp&nbsp&nbsp&nbsp'
          .a('Annotate','../annotation/annotation.php?id_gene='.strval($item['id'])).'</b>'
          ."&nbsp&nbsp&nbsp&nbsp"
          .'<a  href="" onClick="return show(this);">Show</a>'
          .'&nbsp&nbsp'
          .a('Edit', '../edit/edit.php?id_gene='.strval($item['id']))
          .'&nbsp&nbsp'
          .'<a  href="" onClick="return del(this);">Delete</a>'         
          , '');
          
	echo "</tr>";
  }
}

?>