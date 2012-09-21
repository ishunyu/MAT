function $(id) {
  return document.getElementById(id);
}

String.prototype.contains = function(s) {
  return this.indexOf(s) != -1;
}

// Checks if the input is there and that it's a positive number
function is_pos_num(s) {
  if(s == "")
    return false;

  var patt=/[^0-9]/;
  return !s.match(patt);
}