// ----- Annotate -----

function checkbox() {
  return false;
}


function enter(keyStroke) {
  if(keyStroke.keyCode == 13)
    submit_annotation();
}

// Prevents non-numbers from typing
function input_check(keyStroke) {
  // alert(keyStroke.keyCode);

  if((keyStroke.keyCode < 48 || keyStroke.keyCode > 58)
     && keyStroke.keyCode != 8 // Backspace
     && keyStroke.keyCode != 46 // Delete
     && keyStroke.keyCode != 9  // Tab
     && !(keyStroke.ctrlKey && 
          (keyStroke.keyCode == 65 // ctrl + A
          || keyStroke.keyCode == 67 // ctrl + C
          || keyStroke.keyCode == 88 // ctrl + X
          || keyStroke.keyCode == 86 // ctrl + V
          )
         )
    ) {
     if (keyStroke.preventDefault) {
         keyStroke.preventDefault();
     }    
    return false;
  }
}

function add_row(obj) {
  var table = document.getElementById("annotationTable");  
  var row = table.insertRow(-1);
  row.className = "a_row";
  row.id = "row"+obj.id;

    obj.keep = obj.keep ? "Yes" : "no";
    insert ='<td class="feature"> \
              <a href="#" title="remove this annotation" name="'+ obj.id +'" onclick="return remove_annotation(this);">x</a>&nbsp;&nbsp;&nbsp;'+
              obj.feature + '</td>' + 
            '<td class="ida">'+ obj.ida +'</td>' + 
            '<td class="start">'+ obj.start  +'</td>' +
            '<td class="end">'+ obj.end +'</td>' + 
            '<td class="keep">'+ obj.keep +'</td>';

  row.innerHTML = insert;

    // var feature = document.createElement("td");
    //   var a = document.createElement("a");
    //   a.href = "#";
    //   a.title = "remove this annotation";
    //   a.onclick = function(){return remove_annotation(this);};
    //   a.innerHTML = "x";
    // feature.appendChild(a);
    // feature.innerHTML = "&nbsp;&nbsp;"+obj.feature;

    // var ida = document.createElement("td");
    // ida.innerHTML = obj.ida;

    // var start = document.createElement("td");
    // start.innerHTML = obj.start;

    // var end = document.createElement("td");
    // end.innerHTML = obj.end;

    // var keep = document.createElement("td");
    // keep.innerHTML = obj.keep == "true" ? "Yes" : "no";

}

function submit_annotation() {
  var xml;
  if (window.XMLHttpRequest) {  // code for IE7+, Firefox, Chrome, Opera, Safari
    xml = new XMLHttpRequest();
  }
  else {  // code for IE6, IE5
    xml = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      // alert(xml.responseText);
      if(xml.responseText != "") {
        var r_params = new Object();
        r_params.id = xml.responseText;
        r_params.feature = feature;
        r_params.ida = ida;
        r_params.start = start;
        r_params.end = end;
        r_params.keep = keep;
        add_row(r_params);
      }
    }
  }
  xml.open("POST","anno_commit.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var featureIndex = document.getElementById("feature").selectedIndex;
  
  var feature = document.getElementById("feature")[featureIndex].innerHTML;
    // feature = encodeURI(feature);
  var ida = document.getElementById("ida").value;
  var start = document.getElementById("start").value;
  var end = document.getElementById("end").value;
  var keep = document.getElementById("keep").checked;
  var geneId = document.getElementById("geneId").value;
  
  var params = "geneId="+geneId
              +"&feature="+feature
              +"&ida="+ida
              +"&start="+start
              +"&end="+end
              +"&keep="+keep;

  xml.send(params);
}

function remove_row(id) {
  var row = document.getElementById("row"+id);
  var t = document.getElementById("annotationTable");

  t.deleteRow(row.rowIndex);
}

function remove_annotation(obj) {
  var xml;
  if (window.XMLHttpRequest) {  // code for IE7+, Firefox, Chrome, Opera, Safari
    xml = new XMLHttpRequest();
  }
  else {  // code for IE6, IE5
    xml = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      if(xml.responseText == "success") {
        remove_row(id);
      }
      else {
        alert("Removing annotation unsuccessful.")
      }
    }
  }
  xml.open("POST","anno_remove.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var id = obj.name;
  var geneId = document.getElementById("geneId").value;
  
  var params = "geneId="+geneId
              +"&id="+id;
  xml.send(params);
}

/* Start up functions*/
// document.onkeydown = function(){pressedKey(window.event);};

