// ----- Annotate -----
String.prototype.contains = function(s) {
  return this.indexOf(s) != -1;
}

function checkbox() {
  return false;
}

function enter(keyStroke) {
  if(keyStroke.keyCode == 13)
    submit_annotation();
}

function enter_c(keyStroke) {
  if(keyStroke.keyCode == 13)
    deactivate_rows(null);
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

// Dynamically change the annotation data
function activate_row(row, cell) {
  if(!row.className.contains("active")) {  // let's make it editable
    // First, make other rows inactive
    deactivate_rows(row);


    var feature, ida, start, end, keep;
    var i, children = row.childNodes;
    
    for(i = 0;i < children.length; i++) {
      var child = children[i];
      
      if(child.className == "feature_s") {  // feature
        feature = child.innerHTML.trim();
        child.innerHTML = '<select name="feature" class="feature" id="feature" onchange=""> \
                          <option value="2">m7G Cap</option> \
                          <option value="3" selected="selected">promoter</option> \
                          <option value="4">5\'URT</option> \
                          <option value="1">Exon</option> \
                          <option value="0">Intron</option> \
                          <option value="5">3\'URT</option> \
                          <option value="6">Poly(A) tail</option> \
                          <option value="99">other</option> \
                        </select>';
      }
      else if(child.className == "ida") { // ida
        ida = child.innerHTML.trim();
        child.innerHTML = '<input type="text" class="ida inputBoxStyle" id="ida" value="'+ida+'" onkeydown="return enter_c(event);" />';
      }
      else if(child.className == "start") { // start
        start = child.innerHTML.trim();
        child.innerHTML = '<input type="text" class="start_end inputBoxStyle" id="start" value="'+start+'" onkeydown="enter_c(event);return input_check(event);" />';
      }
      else if(child.className == "end") { // end
        end = child.innerHTML.trim();
        child.innerHTML = '<input type="text" class="start_end inputBoxStyle" id="end" value="'+end+'" onkeydown="enter_c(event);return input_check(event);" />';
      }
      else if(child.className == "keep") {  // keep
        keep = child.innerHTML.trim();
        keep = keep == "Yes" ? 'checked="true"' : '';

        child.innerHTML = '<input type="checkbox" class="keep" id="keep" '+keep+'/>';
      }
    }

    row.className = row.className + " active";
  }

  cell.firstChild.focus();

  return true;
}

// Deactivates the single, selected row
function deactivate(row) {
  if(!row.className.contains("active")) // Return if the row is inactive
    return;

  var feature, ida, start, end, keep;
  var i, children = row.childNodes;
  
  for(i = 0;i < children.length; i++) {
    var child = children[i];
    
    if(child.className == "feature_s") {  // feature
      feature = child.firstChild[child.firstChild.selectedIndex].innerHTML;
      
      child.innerHTML = feature;
    }
    else if(child.className == "ida") { // ida
      ida = child.firstChild.value;

      child.innerHTML = ida;
    }
    else if(child.className == "start") { // start
      start = child.firstChild.value;

      child.innerHTML = start;
    }
    else if(child.className == "end") { // end
      end = child.firstChild.value;

      child.innerHTML = end;
    }
    else if(child.className == "keep") {  // keep
      keep = child.firstChild.checked;
      k = keep == true ? 'Yes' : 'No';

      child.innerHTML = k;
    }
  }

  // Delete the active tab
  var index_active = row.className.indexOf("active");
  row.className = row.className.substr(0, index_active).trim();
}

// Deactivate all but the active row
function deactivate_rows(active) {
  var table = document.getElementById("annotationTable");
  var rows = table.rows;
  var i;

  for(i = 0; i < rows.length; i++) {
    if(rows[i].className.contains("active"))
      deactivate(rows[i]);    
  }
}

// Adds a new row of annotation at the bottom of the table
function add_row(obj) {
  var table = document.getElementById("annotationTable");  
  var row = table.insertRow(-1);
  row.className = "a_row";
  row.id = "row"+obj.id;

    obj.keep = obj.keep ? "Yes" : "no";
    insert ='<td><a href="#" title="remove this annotation" name="'+ obj.id +
                '" onclick="return remove_annotation(this);"> \
                <img src="../images/icons/trash_w.png" height="15" width="" /></a></td>'+
            '<td class="feature_s"  onclick="return activate_row(this.parentNode, this);">'+obj.feature + '</td>' + 
            '<td class="ida"  onclick="return activate_row(this.parentNode, this);">'+ obj.ida +'</td>' + 
            '<td class="start"  onclick="return activate_row(this.parentNode, this);">'+ obj.start  +'</td>' +
            '<td class="end"  onclick="return activate_row(this.parentNode, this);">'+ obj.end +'</td>' + 
            '<td class="keep"  onclick="return activate_row(this.parentNode, this);">'+ obj.keep +'</td>';

  row.innerHTML = insert;
}

// Submits the new annotation using AJAX
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

// Removes a row from the table
function remove_row(id) {
  var row = document.getElementById("row"+id);
  var t = document.getElementById("annotationTable");

  t.deleteRow(row.rowIndex);
}

// Removes selected annotation using AJAX
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

