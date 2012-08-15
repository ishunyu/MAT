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
  
  function annotate($anno) {
    $annoCopy = $anno; // For storing the original spec in order
    
    // Sorting the specs according to their places
    function cmpAnno($a, $b) {
      if($a['st'] == $b['st']) {
        return 0;
      }
      return ($a['st'] < $b['st']) ? -1 : 1;
    }
    usort($anno, "cmpAnno");
    
    // Error checking to be done

    // Splicing the gene
    for($i = sizeof($anno)-1; $i >= 0; $i--) {
      if(!$anno[$i]['kp']) {
        $this->sequence = substr_replace($this->sequence,
                                          '',
                                          $anno[$i]['st']-1,
                                          $anno[$i]['ed']-$anno[$i]['st']+1);
      }
    }
    
    return json_encode($annoCopy);
  }
  
} // End of class GENE

?>