// ----- Index -----

// Parsing the GET variables
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

// Perform color changes & automatic user name filling
function indexPageLoads() {
  var _GETArray = getUrlVars();
  
  if(_GETArray.length != 1) {
    var usernameInput = document.getElementById("username");
    var passwordInput = document.getElementById("password");
    
    usernameInput.style.backgroundColor = "pink";
    passwordInput.style.backgroundColor = "pink";
    
    usernameInput.value = _GETArray["username"];
  }
}

// Clear the inputs' background colors
function clearIndexPageInputs() {
  var usernameInput = document.getElementById("username");
  var passwordInput = document.getElementById("password");

  usernameInput.style.backgroundColor = "white";
  passwordInput.style.backgroundColor = "white";
}