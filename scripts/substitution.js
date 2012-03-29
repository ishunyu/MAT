// Shows the gene info
function showGeneInfoWithOptionalMutation(keyStroke) {
  var input = document.getElementById("subsitutionPositionInput");
  
  // If there's a value in the box
  if(input.value != "") {
    // Number
    if(keyStroke.keyCode >= 48 && keyStroke.keyCode <= 58) {
     
    }
    else if(keyStroke.keyCode ==  "a".charCodeAt(0) || 
            keyStroke.keyCode ==  "t".charCodeAt(0) ||
            keyStroke.keyCode ==  "g".charCodeAt(0) ||
            keyStroke.keyCode ==  "c".charCodeAt(0) ||
            keyStroke.keyCode ==  "A".charCodeAt(0) ||
            keyStroke.keyCode ==  "T".charCodeAt(0) ||
            keyStroke.keyCode ==  "G".charCodeAt(0) ||
            keyStroke.keyCode ==  "C".charCodeAt(0)){   // Mutation info   
       
      setButton(String.fromCharCode(keyStroke.keyCode));
      sendAjaxForPosition(input.value, String.fromCharCode(keyStroke.keyCode));
    }
  }
}

// Prevents non-numbers from typing
function sendAjaxForPosition(position, nucleotide) {  
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function() { // the Call back function
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      var responseText = xmlhttp.responseText;      
      document.getElementById("showInfoAboutGeneAtPosition").innerHTML=responseText;
    }
  }
  
  var POSTMessage = "position="+position+"&"+"nucleotide="+nucleotide;
  
  xmlhttp.open("POST","mutateGeneAtPosition.php",true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send(POSTMessage);
}

// Prevents non-numbers from typing
function checkInputForNumber(keyStroke) {
  resetButton();
  
  if((keyStroke.keyCode < 48 || keyStroke.keyCode > 58) && keyStroke.keyCode != 8 && keyStroke.keyCode != 46) {
     if (keyStroke.preventDefault) {
         keyStroke.preventDefault();
     }    
    return false;
  }  
  return true;
}

function setButton(nucleotide) {
  var buttonArray = document.getElementsByTagName("input");
  
  for(i = 0; i < buttonArray.length; i++) {
    if(buttonArray[i].value == nucleotide) {
      buttonArray[i].style.backgroundColor = "#2298B8";
    }
  }
}

function resetButton() {
  var buttonArray = document.getElementsByTagName("input");
  
  for(i = 0; i < buttonArray.length; i++) {
    if(buttonArray[i].type == "button") {
      buttonArray[i].style.backgroundColor = "Grey";
    }
  }
}
