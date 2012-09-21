/* deletion.js */

// Error corrections
function deletion_info(input) {
  var start = document.getElementById('start_index').value;
  var end = document.getElementById('end_index').value;

  if(is_pos_num(start) && is_pos_num(end)) {
    // Change the text to integer so we can compare
    start = parseInt(start);
    end = parseInt(end);

    // Send AJAX
    if(start <= end)
      _deletion_info(start, end);
  }
  else if(input.value != '' && !is_pos_num(input.value)) {
    alert('Enter a non-negative number please!');
    input.value = '';
  }
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
      //console.log(xml.responseText);
      if(xml.responseText != 'failed')
        _deletion_info_helper(xml.responseText);
      else
        alert("There's something wrong with the input!");
    }
  }
}

function _deletion_info_helper(result) {
  var populate = function (key, value) {
    if(key != '') {
      //console.log('key: ' + key + ' value: ' + value);
      document.getElementById(key).innerHTML = value;
    }
  }

  JSON.parse(result, populate);
}