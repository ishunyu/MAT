function $(id) {
  return document.getElementById(id);
}

String.prototype.contains = function(s) {
  return this.indexOf(s) != -1;
}

/* Checks if the input is there and that it's a positive number */
function is_pos_num(s) {
  if(s == "" || s == "0")
    return false;

  var patt=/[^0-9]/;
  return !s.match(patt);
}

/* Calls f if user pressed enter */
function keyboard(keyStroke, f) {
  if(keyStroke.keyCode == 13)
    f();
}

function get_id(row) {
  return row.id.substring(row.id.indexOf("_") + 1);
}

function process_xml_response(r) {
  if(r == ""){
    return true;  /* Went well! */
  }
  else if(r == "success") {
    return true;
  }
  else {
    alert(r);
    return false;
  }
}