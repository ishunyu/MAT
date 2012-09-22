// substitution.js
var stored_index = null;

// Shows the gene info
function info_substitution(base) {
  var index = $("index").value;

  if(is_pos_num(index) && (parseInt(index) > 0)) {    
    _info_substitution(index, base);
  }
}

// Sends the Ajax request
function _info_substitution(index, base) {  
  var xml = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP"); 
  
  xml.open("POST","_substitution.php",true);
  xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");

  var data = "index="+index+"&base="+base;
  xml.send(data);

  xml.onreadystatechange=function() { // the Call back function
    if (xml.readyState==4 && xml.status==200) {
      var resp = xml.responseText;
      if(resp != 'failed')
        $("info_substitution").innerHTML=resp;
    }
  }
}

function info_gene() {
  var index = $('index').value;
  if(index != stored_index)
    $("info_substitution").innerHTML = '<tr><th>New codon:</th><td></td></tr><tr><th>Nucleic acid level:</th><td></td></tr><tr><th>Protein level:</th><td></td></tr>';
  
  if(index == '') {
    $("info_gene").innerHTML = '<tr><th>Base:</th><td></td></tr><tr><th>Codon Position:</th><td></td></tr><tr><th>Old codon:</th><td></td></tr> '
  }

  if(is_pos_num(index) && (parseInt(index) > 0)) {
    stored_index = index;
    _info_gene(index);
  }
  else {
    if(index != "") {
      alert('Enter a non-negative number please!');
      $('index').value = "";
    }
  }
}

// Sends the Ajax request
function _info_gene(index) {  
  var xml = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP"); 
  
  xml.open("POST","_info_gene.php",true);
  xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");

  var data = "index="+index;
  xml.send(data);

  xml.onreadystatechange=function() { // the Call back function
    if (xml.readyState==4 && xml.status==200) {
      var resp = xml.responseText;
      
      console.log(resp);
      if(resp != 'failed')
        $("info_gene").innerHTML=resp;
    }
  }
}


