<?php
class DNA_FILE {
  private $formattedFileName = "formatted";
  private $ownerDirectory = "data\1\\";  //Directory of the member
  private $sequence;  // Stores the DNA sequence
  
  // Constructor with directory link passed in
  function __construct($link) {
    $this->ownerDirectory = $link;  // Stores the directory arguement into the class;
    
    // Debug code
    echo $this->ownerDirectory.$this->formattedFileName;
    echo PHP_EOL;
    
    // 
    if(file_exists($this->ownerDirectory.$this->formattedFileName)) {
      echo "YES</br>";
      $this->readFileData();      
    }
    else {
      echo "NO</br>";
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
      echo "HERE".PHP_EOL;
    
      if(file_exists($writefilePath)) {
      $writefileHandle = fopen($writefilePath,"w");
      
      fwrite($writefileHandle, $this->sequence);
      fclose($writefileHandle);
    }
  }
  
  function getDNA() {
    return $this->sequence;
  }
  
  function getBaseAt($index) {
    return $this->sequence[$index];
  }
  
  function getCodonAt() {
  
  } 
  
} // End of class DNA

// Functions to perform file operations
$link = 'data\test\\';
$member1 = new DNA_FILE($link);

//echo $member1->getDNA();
echo PHP_EOL;
echo $member1->getBaseAt(5000);


?>










