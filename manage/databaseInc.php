<?php
include "../headers/checkSession.php";

function td($string, $class) {
  return "<td class=\"$class\">$string</td>";
}

function drawRows() {
  include "../headers/globalVariables.php";
  
  $dnaListQuery =
    "SELECT geneName
     FROM $geneListTableName
     WHERE memberId = $_SESSION[id]";
  $dnaListQuery = mysql_query($dnaListQuery);    
  
  while($dnaList = mysql_fetch_assoc($dnaListQuery)) {
    echo "<tr>".td($dnaList['geneName'], "formLabel textShadow centeredTable")."</tr>";
  }
}

?>