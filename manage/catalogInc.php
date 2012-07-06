<?php
include "../headers/checkSession.php";

function td($string, $class) {
  return "<td class=\"$class\">$string</td>";
}

function a($string, $link) {
  return "<a href=\"$link\">$string</a>";
}

function drawRows() {
  include "../headers/globalVariables.php";
  
  $dnaListQuery =
    "SELECT geneName
     FROM $geneListTableName
     WHERE memberId = $_SESSION[id]";
  $dnaListQuery = mysql_query($dnaListQuery);    
  
  while($dnaList = mysql_fetch_assoc($dnaListQuery)) {
    echo "<tr>";
	echo td($dnaList['geneName'], "formLabel textShadow labelColumn");
	echo td(a("Mutate","#")."&nbsp&nbsp&nbsp&nbsp".a("Annotate","#"), "detailFormat textShadow");
	echo "</tr>";
  }
}

?>