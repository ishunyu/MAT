<?php
include "../headers/session.php";

function td($string, $class) {
  return "<td class=\"$class\">$string</td>";
}

function a($string, $link) {
  return "<a href=\"$link\">$string</a>";
}

function drawRows() {
  include "../headers/variables.php";
  
  $dnaListQuery =
    "SELECT geneName, id
     FROM $geneListTableName
     WHERE memberId = $_SESSION[id]";
  $dnaListQuery = mysql_query($dnaListQuery);    
  
  while($dnaList = mysql_fetch_assoc($dnaListQuery)) {
  echo "<tr id=\"".strval($dnaList['id'])."\">";
	echo td($dnaList['geneName'], "formLabel textShadow labelColumn");
	echo td(a("Mutate","../mutate/mutate.php?geneID=".strval($dnaList['id']))
          ."&nbsp&nbsp&nbsp&nbsp"
          .a("Annotate","../annotate/annotate.php?geneID=".strval($dnaList['id']))
          ."&nbsp&nbsp&nbsp&nbsp"
          ."<a  href=\"\" onClick=\"return show(this);\">Show</a>"
          ."&nbsp&nbsp&nbsp&nbsp"
          ."<a  href=\"\" onClick=\"return del(this);\">Delete</a>"          
          , "");
          
	echo "</tr>";
  }
}

?>