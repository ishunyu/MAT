// ----- Upload -----

// Checks for file upload
function check_edit() { 
  var geneName = document.getElementById("geneName").value;  // Get the dna title
  var geneId = document.getElementById('geneId').value;
  var xmlhttp = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));
  
  xmlhttp.onreadystatechange=function() { // the Call back function
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      var responseText = xmlhttp.responseText;   

      if(responseText == "true") { // if there is a gene with the same name!
        responseText = geneName + " already exists!";
      }
      else {
        responseText = "";
        document.getElementById("geneEditForm").submit();
      }      
      document.getElementById("geneNameWarning").innerHTML=responseText;
    }
  }
  
  xmlhttp.open("POST","_check_gene.php",true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send("geneName="+geneName+'&geneId='+geneId);
  
  return false;
}

// Updates the word count for dna notes
function word_count_popup(event) {
  var length = document.getElementById("geneNotes").value.length;
  var maxlength = document.getElementById("geneNotes").getAttribute("maxlength");
  if(length == maxlength) {
    if(event.ctrlKey || event.shiftKey || event.altKey) {
      return;
    }
    
    if(event.keyCode < 37  || event.keyCode > 40) {
      alert("Sorry! The max number of characters is " + maxlength + ".");
    }
  }
}
