function $(id) {
  return document.getElementById(id);
}

String.prototype.contains = function(s) {
  return this.indexOf(s) != -1;
}

// Checks if the input is there and that it's a positive number
function is_pos_num(s) {
  if(s == "" || s == "0")
    return false;

  var patt=/[^0-9]/;
  return !s.match(patt);
}

function keyboard(keyStroke, f) {
  if(keyStroke.keyCode == 13)
    f();
}

function process_xml_response(r) {
  if(r == ""){
    return true;  /* Went well! */
  }
  else {
    alert(r);
    return false;
  }
}