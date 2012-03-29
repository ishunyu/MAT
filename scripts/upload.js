// ----- Upload -----

// Checks for file upload
function check_upload() { 
  var xmlhttp;
  var geneName = document.getElementById("geneName").value;  // Get the dna title
  var geneFile = document.getElementById("uploadedFile").value; // Get the file name
  var ext = geneFile.split('.').pop();

  
  if(geneName.length == 0 || geneFile.length < 4 || (ext != "txt")) { // check to see if title is in range and filename is okay
    if(geneName.length == 0) {
      document.getElementById("geneNameWarning").innerHTML = "Name needs to be at least 6 characters!";
    }
    else {
      document.getElementById("geneNameWarning").innerHTML = "";
    }
    
    if(geneFile.length < 4 || (ext != "txt")) {
      document.getElementById("uploadFileWarning").innerHTML = "Please choose a file with valid name and extension.";
    }
    else {
      document.getElementById("uploadFileWarning").innerHTML = "";
    }
    return false;
  }

    
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function() { // the Call back function
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      var responseText = xmlhttp.responseText;   
    
      if(responseText == "true") { // if there is a gene with the same name!
        responseText = geneName + " already exists!";
      }
      else {
         responseText = "";
         document.getElementById("geneUploadForm").submit();
      }      
      document.getElementById("geneNameWarning").innerHTML=responseText;
    }
  }
  
  xmlhttp.open("POST","checkGeneExistsInDatabase.php",true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send("geneName="+geneName);
  
  return false;
}

// Updates the word count for dna notes
function word_count() {
  var length = document.getElementById("geneNotes").value.length;
  length = document.getElementById("geneNotes").getAttribute("maxlength") - length;
  document.getElementById("wordCount").innerHTML= length + " characters left";;
}
