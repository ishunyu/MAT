// ----- Upload -----

// Checks for file upload
function check_upload() {
  var name_gene = document.getElementById("name_gene").value;  // Get the dna title
  var geneFile = document.getElementById("uploadedFile").value; // Get the file name
  var ext = geneFile.split('.').pop();
  ext = ext.toLowerCase();
  
  if(name_gene.length == 0 || geneFile.length < 4 || !(ext == "txt" || ext == "fasta")) { // check to see if title is in range and filename is okay
    if(name_gene.length == 0) {
      document.getElementById("name_geneWarning").innerHTML = "Name needs to be at least 6 characters!";
    }
    else {
      document.getElementById("name_geneWarning").innerHTML = "";
    }
    
    if(geneFile.length < 4 || (ext != "txt")) {
      document.getElementById("uploadFileWarning").innerHTML = "Please choose a file with valid name and extension.";
    }
    else {
      document.getElementById("uploadFileWarning").innerHTML = "";
    }
    return false;
  }

    
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));
  
  xml.onreadystatechange=function() { // the Call back function
    if (xml.readyState==4 && xml.status==200) {
      var responseText = xml.responseText;   
    
      if(responseText == "true") { // if there is a gene with the same name!
        responseText = name_gene + " already exists!";
      }
      else {
         responseText = "";
         document.getElementById("geneUploadForm").submit();
      }      
      document.getElementById("name_geneWarning").innerHTML=responseText;
    }
  }
  
  xml.open("POST","_check_gene.php",true);
  xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xml.send("name_gene="+name_gene);
  
  return false;
}

// Updates the word count for dna notes
function word_count() {
  var length = document.getElementById("notes").value.length;
  length = document.getElementById("notes").getAttribute("maxlength") - length;
  document.getElementById("wordCount").innerHTML= length + " characters left";;
}

function word_count_popup(event) {
  var length = document.getElementById("notes").value.length;
  var maxlength = document.getElementById("notes").getAttribute("maxlength");
  if(length == maxlength) {
    if(event.ctrlKey || event.shiftKey || event.altKey) {
      return;
    }
    
    if(event.keyCode < 37  || event.keyCode > 40) {
      alert("Sorry! The max number of characters is " + maxlength + ".");
    }
  }
}
