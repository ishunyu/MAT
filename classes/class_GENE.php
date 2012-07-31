<?php
//$LUT = json_decode(file_get_contents("classes/LUT.json"), true);
class gene {
  private $sequence;  // Stores the Gene sequence
  private $originalSequence;
  private $lut;
  private $size;
  
  // Constructor with directory link passed in
  function __construct($gene) {
    $this->sequence = $gene;
    $this->size = strlen($gene);
    $this->lut = json_decode(file_get_contents("../classes/LUT.json"), true);
  }
  
  // Getters
  function getGene() {
    return $this->sequence;
  }
  
  function getLut() {
    return $this->lut;
  }
  
  function getSize() {
    return $this->size;
  }
  
  function getBaseAtBaseIndex($indexOfBase) {
    if($indexOfBase > strlen($this->sequence) || $indexOfBase < 1) {  // Error checking
      echo false;
      return;
    }
    
    return $this->sequence[$indexOfBase-1];
  }
  
  function proteinMutationAtBaseIndexWithBase($indexOfBase, $base) {
    // Bounds checking
    if($indexOfBase > $this->size || $indexOfBase < 1) {  // Error checking
      return false;
    } 
    
    $newCodon = $originalCodon = $this->getCodonAtBaseIndex($indexOfBase);  // Get the codon
    $newCodon[$this->positionInCodonOfBaseIndex($indexOfBase) - 1] = $base; // Get the position within codon and change new codon
    
    $originalProtein = $this->lut[$originalCodon]["3LetterCode"]; // Retrieve the protein
    $newProtein = $this->lut[$newCodon]["3LetterCode"];
    
    if($originalProtein == $newProtein) // Silent mutation
      return "See Nucleic acid level.";
    
    $protienMutation = "p.".$originalProtein.$indexOfBase.$newProtein;
    
    return $protienMutation;
  }
  
  function rnaMutationAtBaseIndexWithBase($indexOfBase, $base) {
    // Bounds checking
    if($indexOfBase > $this->size || $indexOfBase < 1) {  // Error checking
      return false;
    } 
    
    $newCodon = $originalCodon = $this->getCodonAtBaseIndex($indexOfBase);  // Get the codon
    $newCodon[$this->positionInCodonOfBaseIndex($indexOfBase) - 1] = $base; // Get the position within codon and change new codon
    
    $originalProtein = $this->lut[$originalCodon]["3LetterCode"]; // Retrieve the protein
    $newProtein = $this->lut[$newCodon]["3LetterCode"];        
    
    $rnaMutation = "c.".$indexOfBase.$this->sequence[$indexOfBase-1].">".$base;
    if($originalProtein == $newProtein) // Silent mutation
      $rnaMutation = $rnaMutation." (p.(=))";

    return $rnaMutation;
  }
  
  function positionInCodonOfBaseIndex($indexOfBase) {
    // Bounds checking
    if($indexOfBase > $this->size || $indexOfBase < 1) {
      return false;
    }  
    
    $positionInCodon = 0;
    
    switch($indexOfBase%3) {  // Finding out which position the base is at
      case 1:
        $positionInCodon = 1;
        break;
      case 2:
        $positionInCodon = 2;
        break;
      case 0:
        $positionInCodon = 3;
        break;
      default:
        break;
    }
    
    return $positionInCodon;
  }
  
  // Finds the codon with the base indexs
  function getCodonAtBaseIndex($indexOfBase) {  
    // Bounds checking
    if($indexOfBase > $this->size || $indexOfBase < 1) {
      return false;
    }  
    
    $left = -1;
    
    switch($indexOfBase%3) {  // Finding out which position the base is at
      case 1: // $indexOfBase $mid $right
        $left = $indexOfBase;
        break;  // $left $indexOfBase $right
      case 2:
        $left = $indexOfBase - 1;
        break;
      case 0: // $left $mid $indexOfBase
        $left = $indexOfBase - 2;
        break;
      default:
        break;
    }
    
    $left--; // Change to computer science term :)
     
    
    return $this->sequence[$left].$this->sequence[$left+1].$this->sequence[$left+2];
  }
  
  function getCodonPositionAtBaseIndex($indexOfBase) {  
    // Bounds checking
    if($indexOfBase > $this->size || $indexOfBase < 1) {
      return false;
    }  
    
    $codonPosition = ceil($indexOfBase / 3);
    
      
    return $codonPosition;        
  }
  
  function spec($rawSpec) {
    // Making the data easier to work with by arranging them in arrays
    $numCol = $rawSpec['numCol'];
    $rawSpec = array_values($rawSpec);  // Changes from assoc to numbers
    $spec = array();
    
    
    $numColMinusOne = $numCol - 1;
    //Fixes the issue with check boxes
    for($i = 2; $i < sizeof($rawSpec);) {
      if($i+$numColMinusOne == sizeof($rawSpec) || $rawSpec[$i+$numColMinusOne] != "on") {  // Checks for the last one spec and spec without checks
        $spec[] = array($rawSpec[$i], $rawSpec[$i+1], $rawSpec[$i+2], $rawSpec[$i+3], FALSE);
        $i+=$numColMinusOne;
      }
      else {  // Specs to keep
        $spec[] = array($rawSpec[$i], $rawSpec[$i+1], $rawSpec[$i+2], $rawSpec[$i+3], TRUE);
        $i+=$numCol;
      }
    }
    
    $returnSpec = $spec; // For storing the original spec in order
    
    // Sorting the specs according to their places
    function cmpSpec($a, $b) {
      if($a[2] == $b[2]) {
        return 0;
      }
      return ($a[2] < $b[2]) ? -1 : 1;
    }
    usort($spec, "cmpSpec");
    
    // Error checking to be done

    // Splicing the gene
    for($i = sizeof($spec)-1; $i >= 0; $i--) {
      $keep = $spec[$i][4];
      if(!$keep) {
        $startColNum = 2;
        $endColNum = 3;
        // echo $this->sequence;
        // echo "<br>";
        $this->sequence = substr_replace($this->sequence, '', $spec[$i][$startColNum]-1, $spec[$i][$endColNum]-$spec[$i][$startColNum]+1);
        // echo $this->sequence;
      }
    }
    
    return json_encode($returnSpec);
  }
  
} // End of class GENE

?>










