<?php
include "DNAdata\DNA_FILE.php";
$LUT = json_decode(file_get_contents("DNAdata\LUT.json"), true);
$output = "";

if(isset($_POST['location'])) {
  $DNA1 = new DNA_FILE($link);
  $codon = $DNA1->getCodonAtIndex($_POST['location']);
  
  $output = $codon.": { ";
  if(isset($LUT[$codon])) {
    foreach($LUT[$codon] as $key => $value) {
      $output = $output.$key.": ".$value.", ";
    }  

    $output[strlen($output)-1] = "}";
    $output[strlen($output)-2] = " ";
  }
  else {
    $output = "";
  }
}

if(isset($_POST['codon'])) {
  $codon = strtoupper($_POST['codon']);
  $output = $codon.": { ";

  if(isset($LUT[$codon])) {
    foreach($LUT[$codon] as $key => $value) {
      $output = $output.$key.": ".$value.", ";
    }  

    $output[strlen($output)-1] = "}";
    $output[strlen($output)-2] = " ";
  }
  else {
    $output = "";
  }
}


?>

<html>
  <head>
    <title>test.php</title>
  </head>
  <body>

  <h4>Please enter the location of your codon:</h4>
    <form action="test.php" method="POST">
      <input type="text" name="location">
      <input type="submit" value="submit">
    </form>   
    
    
    <form name="codonForm" action="test.php" method="POST">
      <h4>Please enter a codon:</h4><input type="text" id="codon" name="codon">
      <input name="codonInput" type="submit" value="submit">    
    </form>
    <?php if($output != "") {
            echo $output;
           }
           else {
            echo "</br>";
           }
    ?>
    
  </body>
</html>

<script type="text/javascript">
      document.getElementById('codon').focus();
</script>
