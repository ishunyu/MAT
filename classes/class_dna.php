<?php
//$LUT = json_decode(file_get_contents("classes\LUT.json"), true);
class DNA_FILE {
  private $formattedFileName = "formatted";
  private $ownerDirectory = "../data\1\\";  //Directory of the member
  private $sequence;  // Stores the DNA sequence
  
  // Constructor with directory link passed in
  function __construct($link) {
    $this->ownerDirectory = $link;  // Stores the directory path into the class;
    
    // Debug code
    //echo $this->ownerDirectory.$this->formattedFileName;
    //echo PHP_EOL;
    
    // 
    if(file_exists($this->ownerDirectory.$this->formattedFileName)) {
      //echo "YES</br>";
      $this->readFileData();      
    }
    else {
      //echo "NO</br>";
      $this->readFileData();
      $this->writeFileData();
    }
  }
  
  // Retrieves the file data, saves to the variable
  private function readFileData() {
    $readfilePath = $this->ownerDirectory."original"; // Forms the location to the original file
    
    if(file_exists($readfilePath)) {
      $readfileHandle = fopen($readfilePath, "r");  // Creates the file pointer
      $readfileData = fread($readfileHandle, fileSize($readfilePath));  // Imports the data from file
      
      $array_whitespaces = array("\n","\r"," ");  // Array that contains possible whitespace characters
      $this->sequence = str_replace($array_whitespaces,"",$readfileData);  // Strip out whitespaces, newlines, carraige returns
      
      fclose($readfileHandle);  // Close the file
    }
  }
  
  // Writes the DNA sequence in our own way
  private function writeFileData() {
    
    $writefilePath = $this->ownerDirectory.$this->formattedFileName;
    echo $writefilePath.PHP_EOL;
    
      
    $writefileHandle = fopen($writefilePath,"w");
    
    fwrite($writefileHandle, $this->sequence);
    fclose($writefileHandle);

  }
  
  function getDNA() {
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
  
} // End of class DNA

// Functions to perform file operations
$link = 'data\test\\';
//$member1 = new DNA_FILE($link);

?>










