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
  
  function get_size() {
    return $this->size;
  }

  function get_codon_info($index) {
    $codon = $this->get_codon_base_index($index);
    return $this->lut[$codon];
  }
  
  function get_base($index) {
    if($index > strlen($this->sequence) || $index < 1) {  // Error checking
      return false;
    }
    
    return $this->sequence[$index-1];
  }
  
  function protein_mutation($index, $base) {
    // Bounds checking
    if($index > $this->size || $index < 1) {  // Error checking
      return false;
    } 
    
    $new_codon = $old_codon = $this->get_codon_base_index($index);  // Get the codon
    $new_codon[$this->get_position_in_codon($index) - 1] = $base; // Get the position within codon and change new codon
    
    $old_protein = $this->lut[$old_codon]["3LetterCode"]; // Retrieve the protein
    $new_protein = $this->lut[$new_codon]["3LetterCode"];
    
    if($old_protein == $new_protein) // Silent mutation
      return "p.(=)";
    
    $protienMutation = "p.".$old_protein.$index.$new_protein;
    
    return $protienMutation;
  }
  
  function rna_mutation($index, $base) {
    // Bounds checking
    if($index > $this->size || $index < 1) {  // Error checking
      return false;
    } 
    
    $new_codon = $old_codon = $this->get_codon_base_index($index);  // Get the codon
    $new_codon[$this->get_position_in_codon($index) - 1] = $base; // Get the position within codon and change new codon
    
    $old_protein = $this->lut[$old_codon]["3LetterCode"]; // Retrieve the protein
    $new_protein = $this->lut[$new_codon]["3LetterCode"];        
    
    $rnaMutation = "c.".$index.$this->sequence[$index-1].">".$base;
    return $rnaMutation;
  }
  
  function get_position_in_codon($index) {
    // Bounds checking
    if($index > $this->size || $index < 1) {
      return false;
    }  
    
    $position_in_codon = 0;
    
    switch($index % 3) {  // Finding out which position the base is at
      case 1:
        $position_in_codon = 1;
        break;
      case 2:
        $position_in_codon = 2;
        break;
      case 0:
        $position_in_codon = 3;
        break;
      default:
        break;
    }
    
    return $position_in_codon;
  }
  
  // Finds the codon with the base index
  function get_codon_base_index($index) {  
    // Bounds checking
    if($index > $this->size || $index < 1) {
      return false;
    }  
    
    $left = -1;
    
    switch($index % 3) {  // Finding out which position the base is at
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
      
    return ceil($index / 3.0);        
  }
  
  function annotate($exons) {   
    // Error checking to be done
    $tmp = '';

    // Splicing the gene
    foreach($exons as $item) {
      $tmp .= substr($this->sequence, $item['start'] - 1, $item['end']-$item['start']+1);
    }

    $this->sequence = $tmp;
    return $this->sequence;
  }

  function exons($annotations) {
    // Finding exon info
    $annotations = json_decode(stripcslashes($annotations), true);
    $exons = array();

    // Extract the exon info from annotations
    foreach($annotations as $item) {
      if($item['ftr'] == '3')
        $exons[] = $item;
    }

    // Sort the exon info
    function cmp_annotations($a, $b) {
      if($a['st'] == $b['st']) {
        return 0;
      }
      return ($a['st'] < $b['st']) ? -1 : 1;
    }
    usort($exons, "cmp_annotations");

    // Shift the exon information over
    if(sizeof($exons) > 0) {
      $anchor = 0;

      foreach($exons as $key => $item) {
        $diff = $exons[$key]['end'] - $exons[$key]['st'];
        $exons[$key]['st'] = $anchor + 1;
        $anchor = $exons[$key]['end'] = $exons[$key]['st'] + $diff;    
      }
    }
    // Exon information extraction complete

    return $exons;
  }

  // Gets the new codon info
  function get_new_codon_info($start, $end) {
    // Gets the relative position of the base in its respective codon
    $start_in_codon = $this->get_position_in_codon($start);

    // Change to computer science terms
    $start--;
    $end--;

    $new_codon = '';

    if(($start_in_codon == 1) && (($end + 3) <= $this->size)) { // start mid right -> end+1 end+2 end+3
      $new_codon = $this->sequence[$end + 1].$this->sequence[$end + 2].$this->sequence[$end + 3];

    }
    else if(($start_in_codon == 2) && (($end + 2) <= $this->size)) { // left start right - > start-1 end+1 end+2
      $new_codon = $this->sequence[$start - 1].$this->sequence[$end + 1].$this->sequence[$end + 2];

    }
    else if(($start_in_codon == 3) && (($end + 1) <= $this->size)) {// left mid start -> start-2 start-1 end+1
      $new_codon = $this->sequence[$start - 2].$this->sequence[$start - 1].$this->sequence[$end + 1];
      
    }
    else {
      return false;
    }

    return $this->lut[$new_codon];
  }

  function stop_codon($start, $end) {
    // If the $end is greater than the sequence, then no show :(|)
    if($end > $this->size)
      return false;

    // Form the new gene
    $new_gene = substr_replace($this->sequence, '', $start - 1, $end - $start + 1);

    // Start going through the gene and count
    $count = 0;
    $output = ' ';

    // Offset for the position inside codon
    $shift_in_codon = ($this->get_position_in_codon($start) - 1) * -1;
    $start += $shift_in_codon;

    for($i = ($start - 1); ($i + 3) < strlen($new_gene); $i += 3) {
      $count++;
      $codon = substr($new_gene, $i, 3);
      $output .= $count.' '.$codon."  ";

      if($this->lut[$codon]['1LetterCode'] == 'X') {
        return $count;
      }
    }
  }

} // End of class GENE

?>