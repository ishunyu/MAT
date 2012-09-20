// ----- Register -----

// Checks the form before submitting for register
function checkRegForm() {      
  var name_first = document.getElementById("name_first").value;
  var name_last = document.getElementById("name_last").value; 
  var password1 = document.getElementById("password1").value;
  var password2 = document.getElementById("password2").value;
  var username = document.getElementById("username").value;
  var returnValue = false;
  
  // Check to see if all fields are filled
  if(!(name_first.match(/\S/) &&
  name_last.match(/\S/) &&
  password1.match(/\S/) &&
  password2.match(/\S/) &&
  username.match(/\S/))) {
    showRegError("Please fill in all forms please!");       
    return false;
  }
  
  if(/\W/g.test(name_first) || /\W/g.test(name_last)) {
    showRegError("Form fields contains illegal characters!");     
    return false;
  }
  
  // Check to see if pass words match
  if(password1 != password2) {
    showRegError("Passwords don't match!");          
    return false;
  }
  
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));
  
  xml.onreadystatechange=function() { // the Call back function
    if (xml.readyState==4 && xml.status==200) {
      var responseText = xml.responseText;   
    
      if(responseText == "true") { // if there is a gene with the same name!
        responseText = username + " already exists!";
      }
      else {
         responseText = "";
         document.getElementById("registerForm").submit();
      }      
      document.getElementById("inputErrorMessage").innerHTML=responseText;
    }
  }
  
  xml.open("POST","_check_user.php",true);
  xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xml.send("username="+username);
  
  return false;
}

// Show the register errors
function showRegError(s) {
  document.getElementById("inputErrorMessage").innerHTML = s;
}
