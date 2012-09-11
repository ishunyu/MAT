// deletion.js

// Checks if the input is there and that it's a positive number
function is_pos_num(s) {
  if(s == "")
    return false;

  var patt=/[^0-9]/;
  return !s.match(patt);
}

// Error corrections
function deletion_info() {
  var start = document.getElementById('start_index').value;
  var end = document.getElementById('end_index').value;

  _deletion_info(start, end);

/*  if(is_pos_num(start) && is_pos_num(end)) {
    // Change the text to integer so we can compare
    start = parseInt(start);
    end = parseInt(end);

    // Make sure the numbers aren't ZERO's
    if(start == 0 || end == 0)
      return;

    // Send AJAX
    if(start <= end)
      _deletion_info(start, end);
  }*/
}

// Actual AJAX functions
function _deletion_info(start, end) {
  // Create new AJAX variable
  var xml = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

  // Set AJAX attributes
  xml.open("POST","_deletion.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  // Send with POST data
  var data = "start=" + start + "&end=" + end;
  xml.send(data);

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      console.log(xml.responseText);

    }
  }
}