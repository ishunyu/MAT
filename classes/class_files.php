<?php
	function getDataFromTempFile($path) {
		$fileHandle = fopen($path, "r");	// Creates the file pointer
		$fileData = fread($fileHandle, fileSize($path));	// Imports the data from file
		
		return $fileData;
	}
	
	function cleanUploadedData($data) {
		$array_whitespaces = array("\n","\r"," ");  // Array that contains possible whitespace characters
		$data = str_replace($array_whitespaces,"",$data);  // Strip out whitespaces, newlines, carraige returns
		
		return $data;
	}

?>