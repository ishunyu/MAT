<?php
//$LUT = json_decode(file_get_contents("classes/LUT.json"), true);
class GENE {
  private $sequence;  // Stores the Gene sequence
  private $lut;
  private $size;
  
  // Constructor with directory link passed in
  function __construct($gene) {
    $this->sequence = $gene;
    $this->size = strlen($gene);
    $this->lut = json_decode(file_get_contents("../classes/LUT.json"), true);
  }
  
  // Getters
  function get_gene() {
    return $this->sequence;
  }
  
  function get_look_up_table() {
    return $this->lut;
  }
  
  function get_size() {
    return $this->size;
  }

  function get_codon_info($codon) {
    return $this->lut[$codon];
  }
  
  function get_base($index) {
    if($index > strlen($this->sequence) || $index < 1) {  // Error checking
      echo false;
      return;
    }
    
    return $this->sequence[$index-1];
  }
  
  function protein_mutation($index, $base) {
    // Bounds checking
    if($index > $this->size || $index < 1) {  // Error checking
      return false;
    } 
    
    $newCodon = $originalCodon = $this->get_codon($index);  // Get the codon
    $newCodon[$this->get_position_in_codon($index) - 1] = $base; // Get the position within codon and change new codon
    
    $originalProtein = $this->lut[$originalCodon]["3LetterCode"]; // Retrieve the protein
    $newProtein = $this->lut[$newCodon]["3LetterCode"];
    
    if($originalProtein == $newProtein) // Silent mutation
      return "p.(=)";
    
    $protienMutation = "p.".$originalProtein.$index.$newProtein;
    
    return $protienMutation;
  }
  
  function rna_mutation($index, $base) {
    // Bounds checking
    if($index > $this->size || $index < 1) {  // Error checking
      return false;
    } 
    
    $newCodon = $originalCodon = $this->get_codon($index);  // Get the codon
    $newCodon[$this->get_position_in_codon($index) - 1] = $base; // Get the position within codon and change new codon
    
    $originalProtein = $this->lut[$originalCodon]["3LetterCode"]; // Retrieve the protein
    $newProtein = $this->lut[$newCodon]["3LetterCode"];        
    
    $rnaMutation = "c.".$index.$this->sequence[$index-1].">".$base;
    return $rnaMutation;
  }
  
  function get_position_in_codon($index) {
    // Bounds checking
    if($index > $this->size || $index < 1) {
      return false;
    }  
    
    $positionInCodon = 0;
    
    switch($index % 3) {  // Finding out which position the base is at
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
  function get_codon($index) {  
    // Bounds checking
    if($index > $this->size || $index < 1) {
      return false;
    }  
    
    $left = -1;
    
    switch($index%3) {  // Finding out which position the base is at
      case 1: // $index $mid $right
        $left = $index;
        break;  // $left $index $right
      case 2:
        $left = $index - 1;
        break;
      case 0: // $left $mid $index
        $left = $index - 2;
        break;
      default:
        break;
    }
    
    $left--; // Change to computer science term :)
     
    
    return $this->sequence[$left].$this->sequence[$left+1].$this->sequence[$left+2];
  }
  
  function get_codon_position($index) {  
    // Bounds checking
    if($index > $this->size || $index < 1) {
      return false;
    }  
    
    $codonPosition = ceil($index / 3);
    
      
    return $codonPosition;        
  }
  
  function annotate($anno) {
    unset($anno['max_id']);
    
    // Sorting the specs according to their places
    function cmpAnno($a, $b) {
      if($a['st'] == $b['st']) {
        return 0;
      }
      return ($a['st'] < $b['st']) ? -1 : 1;
    }
    usort($anno, "cmpAnno");
    
    // Error checking to be done    

    $tmp = '';

    // Splicing the gene
    foreach($anno as $item) {
      if($item['ftr'] == '3') {
        $tmp .= substr($this->sequence, $item['st'] - 1, $item['end']-$item['st']+1);
      }
    }

    $this->sequence = $tmp;
  }
  
} // End of class GENE

?>