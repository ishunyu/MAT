<?php
//$LUT = json_decode(file_get_contents("classes\LUT.json"), true);
class gene {
  private $sequence;  // Stores the Gene sequence
  
  // Constructor with directory link passed in
  function __construct($gene) {
    $this->sequence = $gene;
  }
  
  function getGene() {
    return $this->sequence;
  }
  
  function getBaseAtIndex($indexOfBase) {
    if($indexOfBase > strlen($this->sequence) || $indexOfBase < 1) {
      echo "indexOfBase out of range";
      return;
    }
    
    return $this->sequence[$indexOfBase-1];
  }
  
  function getCodonAtIndex($indexOfCodon) {  
    if($indexOfCodon > (strlen($this->sequence)/3) || $indexOfCodon < 1) {
      echo "indexOfCodon out of range";
      return;
    }
    
    return $this->sequence[($indexOfCodon-1)*3].$this->sequence[($indexOfCodon-1)*3+1].$this->sequence[($indexOfCodon-1)*3+2];
  }
  
  function spec($rawSpec) {
    // Making the data easier to work with by arranging them in arrays
    $rawSpec = array_values($rawSpec);
    $spec = array();
    for($i = 1; $i < sizeof($rawSpec);) {
      if($i+3 == sizeof($rawSpec) || $rawSpec[$i+3] != "on") {  // Checks for the last one spec and spec without checks 
        $spec[] = array($rawSpec[$i], $rawSpec[$i+1], $rawSpec[$i+2], FALSE);
        $i+=3;
      }
      else {  // Specs to keep
        $spec[] = array($rawSpec[$i], $rawSpec[$i+1], $rawSpec[$i+2], TRUE);
        $i+=4;
      }
    }

    // Sorting the specs according to their places
    function cmpSpec($a, $b) {
      if($a[1] == $b[1]) {
        return 0;
      }
      return ($a[1] < $b[1]) ? -1 : 1;
    }
    usort($spec, "cmpSpec");

    // Splicing the gene
    for($i = sizeof($spec)-1; $i >= 0; $i--) {
      if(!$spec[$i][3]) {
        $this->sequence = substr_replace($this->sequence, '', $spec[$i][1]-1, $spec[$i][2]-$spec[$i][1]+1);
      }
    }
  }
  
} // End of class GENE

?>










