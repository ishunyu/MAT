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


function check_upload() { // Checks for file upload
  var xmlhttp;
  var titleName = document.getElementById("dna_name").value;  // Get the dna title
  var fileName = document.getElementById("upload_file_button").value; // Get the file name
  var ext = fileName.split('.').pop();
  var returnValue = false;
  
  if(titleName.length < 6 || fileName.length < 1 || (ext != "txt")) { // check to see if title is in range and filename is okay
    if(titleName.length < 6) {
      document.getElementById("div_content_box_main_A11").innerHTML = "Name needs to be at least 6 characters!";
    }
    else {
      document.getElementById("div_content_box_main_A11").innerHTML = "";
    }
    
    if(fileName.length < 1 || (ext != "txt")) {
      document.getElementById("div_content_box_main_A21").innerHTML = "Please choose a file with valid name and extension.";
    }
    else {
      document.getElementById("div_content_box_main_A21").innerHTML = "";
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
        responseText = titleName + " already exists!";
        returnValue = false;
      }
      else if(responseText == "false") {        
        returnValue = true;
      }
      
      document.getElementById("div_content_box_main_A11").innerHTML=responseText;
      return returnValue;
    }
  }
  
  xmlhttp.open("POST","upload_checker.php",true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send("titleName="+titleName);
}

function word_count() {
  var x = document.getElementById("dna_notes").value.length;
  x = document.getElementById("dna_notes").getAttribute("maxlength") - x;
  document.getElementById("div_content_box_main_B2_wordcount").innerHTML= x + " characters left";;
}












