// ----- Register -----

// Checks the form before submitting for register
function checkRegForm() {      
  var firstName = document.getElementById("reg_firstName").value;
  var lastName = document.getElementById("reg_lastName").value; 
  var password1 = document.getElementById("reg_password1").value;
  var password2 = document.getElementById("reg_password2").value;
  var username = document.getElementById("reg_username").value;
  var returnValue = false;
  
  // Check to see if all fields are filled
  if(!(firstName.match(/\S/) &&
  lastName.match(/\S/) &&
  password1.match(/\S/) &&
  password2.match(/\S/) &&
  username.match(/\S/))) {
    showRegError("Please fill in all forms please!");       
    return false;
  }
  
  if(/\W/g.test(firstName) ||
  /\W/g.test(lastName) /* ||
  /\W/g.test(password1) ||
  /\W/g.test(password2) ||
  /\W/g.test(username) */
  ) {
    showRegError("Form fields contains illegal characters!");     
    return false;
  }
  
  // Check to see if pass words match
  if(password1 != password2) {
    showRegError("Passwords don't match!");          
    return false;
  }
  
  var xmlhttp;
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
        responseText = username + " already exists!";
      }
      else {
         responseText = "";
         document.getElementById("registerForm").submit();
      }      
      document.getElementById("inputErrorMessage").innerHTML=responseText;
    }
  }
  
  xmlhttp.open("POST","_check_user.php",true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send("username="+username);
  
  return false;
  
/*  
  if(password1 == username) {
    showRegError("Password is same as Account Name!");
    return false;       
  }
  
  if((password1.search(firstName) != -1) || (password1.search(lastName) != -1)) {
    showRegError("Password contains First/Last name!");
    return false;
  }
  
  if(username.length < 4) {
    showRegError("Account Name needs to have 4 characters!");
    return false;
  }
  
 
  if(!(username.search(/[A-z_]/) == 0)) {
    showRegError("Account Name needs to start with a letter!");
    return false;
  } */
}

// Show the register errors
function showRegError(s) {
  document.getElementById("inputErrorMessage").innerHTML = s;
}
