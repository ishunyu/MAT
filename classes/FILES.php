<?php
	function getDataFromTempFile($path, $extension) {
		$fileHandle = fopen($path, "r");	// Creates the file pointer		

    if(strtolower($extension) == "fasta") { // The case where the extension is .fasta
      fgets($fileHandle); // Clears first line
    }
		$fileData = fread($fileHandle, fileSize($path));	// Imports the data from file

		return $fileData;
	}
	
	function cleanUploadedData($data) {
		$array_whitespaces = array("\n","\r"," ");  // Array that contains possible whitespace characters
		$data = str_replace($array_whitespaces,'',$data);  // Strip out whitespaces, newlines, carraige returns
		$data = strtoupper($data);  // turns everything into capital
    
		return $data;
	}

?>