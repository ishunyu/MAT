<?php
 // list all the table in database
 $result = mysql_query("show tables");
 // show all the field with type, lenght,description of a specific table
 $result = mysql_query("DESCRIBE $geneListTableName");
 // show a specific tables row 
 $result = mysql_query("SELECT * FROM $geneListTableName");
 //$command= "CREATE TABLE $geneListTableName (id INTEGER(10), geneName CHAR(30), geneOriginal CHAR(30))";
 //$result2 = mysql_query($command,$connection);
 if (mysql_num_rows($result)>0){
 $r = mysql_fetch_array($result,MYSQL_ASSOC);
 $table="<table><tr>";
 $firstLine="<tr>";
 foreach ($r as $k => $v){
   $table .="<td>".$k."</td>";
   $firstLine .="<td>".$v."</td>";
 }
 $table.="</tr>".$firstLine."</tr>";
 while($r = mysql_fetch_array($result,MYSQL_ASSOC)){
   $table.="<tr>";
   foreach($r as $k => $v)
     $table.="<td>".$v."</td>";
   $table.="</tr>";
 }
  $table .="</table>";
 echo $table;
}
?>