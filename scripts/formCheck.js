function checkRegForm() {      
  var firstName = document.getElementById("reg_firstName").value;
  var lastName = document.getElementById("reg_lastName").value; 
  var password1 = document.getElementById("reg_password1").value;
  var password2 = document.getElementById("reg_password2").value;
  var accountname = document.getElementById("reg_accountName").value;
  var returnValue = false;
  
  document.getElementById("submitButton").value="YES!";
  
  // Check to see if all fields are filled
  if(!(firstName.match(/\S/) &&
  lastName.match(/\S/) &&
  password1.match(/\S/) &&
  password2.match(/\S/) &&
  accountname.match(/\S/))) {
    showRegError("Please fill in all forms please!");       
    return false;
  }
  
  if(/\W/g.test(firstName) ||
  /\W/g.test(lastName) ||
  /\W/g.test(password1) ||
  /\W/g.test(password2) ||
  /\W/g.test(accountname)
  ) {
    showRegError("Form fields contains illegal characters!");     
    return false;
  }
  
  if(password1.length < 6) {
    showRegError("Password need to be at least 6 charaters!");
    return false;
  }
  
  // Check to see if pass words match
  if(password1 != password2) {
    showRegError("Passwords don't match!");          
    return false;
  }
  
  
  if(password1 == accountname) {
    showRegError("Password is same as Account Name!");
    return false;       
  }
  
  if((password1.search(firstName) != -1) || (password1.search(lastName) != -1)) {
    showRegError("Password contains First/Last name!");
    return false;
  }
  
  if(accountname.length < 4) {
    showRegError("Account Name needs to have 4 characters!");
    return false;
  }
  
 
  if(!(accountname.search(/[A-z_]/) == 0)) {
    showRegError(accountname.search(/[A-z_]/));
    return false;
  }
}

function showRegError(s) {
  document.getElementById("inputErrorMessage").innerHTML = s;
  document.getElementById("inputErrorMessage").style.color = "orange";
  document.getElementById("inputErrorMessage").style.fontWeight = "bold";
  document.getElementById("inputErrorMessage").style.fontSize = "14px";
  document.getElementById("submitButton").value="NO!";
}