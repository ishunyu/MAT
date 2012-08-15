// ----- Annotate -----

// Automtically checks/unchecks the keep box depending on the type of gene
function checkCheckbox(row) {
  return false;
  var keepId = "keep"+row.id.substr(row.id.search(/\d/)); // Getting the id of the checkbox
  var selection = row.options[row.selectedIndex].value; // Getting the value of the dropdown list item

  var keep = document.getElementById(keepId); // Getting the checkbox corresponding to the row
  
  // Perform the check/unchecked operation
  if(selection == "0") {
    keep.checked = false;
  }
  else if(selection == "1") {
    keep.checked = true;
  }
  else {
    document.write("Shouldn't be here");
  }
}

// Prevents non-numbers from typing
function checkInputForNumber(keyStroke) {
  // alert(keyStroke.keyCode);

  if((keyStroke.keyCode < 48 || keyStroke.keyCode > 58)
     && keyStroke.keyCode != 8 // Backspace
     && keyStroke.keyCode != 46 // Delete
     && keyStroke.keyCode != 9  // Tab
     && !(keyStroke.ctrlKey && 
          (keyStroke.keyCode == 65 // ctrl + A
          || keyStroke.keyCode == 67 // ctrl + C
          || keyStroke.keyCode == 88 // ctrl + X
          || keyStroke.keyCode == 86 // ctrl + V
          )
         )
    ) {
     if (keyStroke.preventDefault) {
         keyStroke.preventDefault();
     }    
    return false;
  }
}

function pressedKey(keyStroke) {
  if(keyStroke.shiftKey && keyStroke.keyCode == "A".charCodeAt(0)) {
    addRow();
  }  
  else if(keyStroke.shiftKey && keyStroke.keyCode == "D".charCodeAt(0)) {
    delRow();
  }  
  else if(keyStroke.shiftKey && keyStroke.keyCode == "C".charCodeAt(0)) {
    clearRows();
  }
}

function submitAnnotation() {
  var xml;
  if (window.XMLHttpRequest) {  // code for IE7+, Firefox, Chrome, Opera, Safari
    xml = new XMLHttpRequest();
  }
  else {  // code for IE6, IE5
    xml = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      document.location.reload(true);
    }
  }
  xml.open("POST","anno_commit.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var featureIndex = document.getElementById("feature").selectedIndex;
  
  var feature = document.getElementById("feature")[featureIndex].value;
  var ida = document.getElementById("ida").value;
  var start = document.getElementById("start").value;
  var end = document.getElementById("end").value;
  var keep = document.getElementById("keep").checked;
  var geneId = document.getElementById("geneId").value;
  
  var params = "geneId="+geneId
              +"&feature="+feature
              +"&ida="+ida
              +"&start="+start
              +"&end="+end
              +"&keep="+keep;
  xml.send(params);
}

function remove(obj) {
  var xml;
  if (window.XMLHttpRequest) {  // code for IE7+, Firefox, Chrome, Opera, Safari
    xml = new XMLHttpRequest();
  }
  else {  // code for IE6, IE5
    xml = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      document.location.reload(true);
    }
  }
  xml.open("POST","anno_remove.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var id = obj.name;
  var geneId = document.getElementById("geneId").value;
  
  var params = "geneId="+geneId
              +"&id="+id;
  xml.send(params);
}

/* Start up functions*/
document.onkeydown = function(){pressedKey(window.event);};

