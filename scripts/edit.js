// ----- Upload -----

// Checks for file upload
function check_edit() { 
  var name_gene = document.getElementById("name_gene").value;  // Get the dna title
  var id_gene = document.getElementById('id_gene').value;
  var xmlhttp = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));
  
  xmlhttp.onreadystatechange=function() { // the Call back function
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      var responseText = xmlhttp.responseText;   

      if(responseText == "true") { // if there is a gene with the same name!
        responseText = name_gene + " already exists!";
      }
      else {
        responseText = "";
        document.getElementById("geneEditForm").submit();
      }      
      document.getElementById("name_geneWarning").innerHTML=responseText;
    }
  }
  
  xmlhttp.open("POST","_check_gene.php",true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send("name_gene="+name_gene+'&id_gene='+id_gene);
  
  return false;
}

// Updates the word count for dna notes
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
