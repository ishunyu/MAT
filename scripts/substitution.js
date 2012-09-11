// Shows the gene info
function showGeneInfoWithOptionalMutation(keyCode) {
  var input = document.getElementById("subsitutionPositionInput");
  
  // If there's a value in the box
  if(input.value != "") {
    // Number
    if(keyCode >= 48 && keyCode <= 58) {
      resetButton();
    }
    else if(keyCode ==  "a".charCodeAt(0) || 
            keyCode ==  "t".charCodeAt(0) ||
            keyCode ==  "g".charCodeAt(0) ||
            keyCode ==  "c".charCodeAt(0) ||
            keyCode ==  "A".charCodeAt(0) ||
            keyCode ==  "T".charCodeAt(0) ||
            keyCode ==  "G".charCodeAt(0) ||
            keyCode ==  "C".charCodeAt(0)){   // Mutation info   
      
      resetButton();
      setButton(String.fromCharCode(keyCode));
      sendAjaxForPosition(input.value, String.fromCharCode(keyCode));
    }
  }
}

// Sends the Ajax request
function sendAjaxForPosition(index, base) {  
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
  
  var POSTMessage = "index="+index+"&"+"base="+base;
  
  xmlhttp.open("POST","_substitution.php",true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send(POSTMessage);
}

// Prevents non-numbers from typing
function checkInputForNumber(keyStroke) {
  if((keyStroke.keyCode > 93 && keyStroke.keyCode < 106) || 
     (keyStroke.keyCode > 41 && keyStroke.keyCode < 36))
    return true;
  
  if((keyStroke.keyCode < 48 || keyStroke.keyCode > 58) 
     && keyStroke.keyCode != 8
     && keyStroke.keyCode != 46) {
     if (keyStroke.preventDefault) {
         keyStroke.preventDefault();
     }    
    return false;
  }  
  return true;
}

// Sets the button to be shown blue
function setButton(base) {
  var buttonArray = document.getElementsByTagName("input");
  
  for(i = 0; i < buttonArray.length; i++) {
    if(buttonArray[i].value == base) {
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
