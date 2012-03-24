<?php
  include "../headers/check_session.php";
  
  $showDNA = "";
  $DNATitle = "Upload a new DNA";
  
  if(isset($_SESSION['LastDNAID'])) {
    $DNAID = $_SESSION['LastDNAID'];
    
     // echo "ID:".$DNAID;
    
    $query_DNA = "SELECT * FROM $tableName_genelisttable WHERE ID='$DNAID'";
    $result_DNA = mysql_query($query_DNA);
    $assoc_DNA = mysql_fetch_assoc($result_DNA);
    
    $DNASpec = $assoc_DNA['Spec'];
    $DNA = $assoc_DNA['DNA'];
    $DNATitle = $assoc_DNA['DNAName'];
    $showDNA = substr($DNA, 0, 30);
    $showDNA = $showDNA."...";
  }
  

?>