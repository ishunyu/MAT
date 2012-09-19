// ----- Annotate -----
// Global PARAMS object, reduces database requests
var PARAMS_OBJ = new Object();

String.prototype.contains = function(s) {
  return this.indexOf(s) != -1;
}

function checkbox() {
  return false;
}

// Used for submitting
function enter(keyStroke) {
  if(keyStroke.keyCode == 13)
    submit_annotation();
}

// Used for while editing
function enter_c(keyStroke) {
  if(keyStroke.keyCode == 13)
    deactivate_active_rows(null);
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

function make_row_plain(row, params) {
  console.log("here");
  // Commit the change on the front end
  var i, children = row.childNodes;
  for(i = 0;i < children.length; i++) {
    child = children[i];
    if(child.className == "controls") {
      var j;
      for(j = 0; j < child.childNodes.length; j++) {
        if(child.childNodes[j].title == "edit") {
          var edit_image = child.childNodes[j].firstChild.nextSibling;
          edit_image.src = "../images/icons/file_3_white.png";
        }
      }
    }
    else if(child.className == "feature_s") {  // feature
      child.innerHTML = params.feature_name;
    }
    else if(child.className == "ida") { // ida
      child.innerHTML = params.ida;
    }
    else if(child.className == "start") { // start
      child.innerHTML = params.start;
    }
    else if(child.className == "end") { // end
      child.innerHTML = params.end;
    }
  }

  // Delete the active class name
  var index_active = row.className.indexOf("active");
  row.className = row.className.substr(0, index_active).trim();
}

function activate_row_helper(children) {
  var feature, feature_name, ida, start, end, i;

  for(i = 0;i < children.length; i++) { // bookmark
    var child = children[i];
    
    if(child.className == "controls") { // Change edit image to confirm image
      var j;
      for(j = 0; j < child.childNodes.length; j++) {
        if(child.childNodes[j].title == "edit") {
          var edit_image = child.childNodes[j].firstChild.nextSibling;
          edit_image.src = "../images/icons/tick_2_white.png";
        }
      }
    }
    else if(child.className == "feature_s") {  // feature
      feature_name = child.innerHTML.trim();
      console.log();
      child.innerHTML = '<select name="feature_edit" class="feature edit" id="feature_edit" onchange="">'+document.getElementById('feature').innerHTML+'</select>';
      var sel = child.firstChild;

      var j;
      for(j = 0; j < sel.length; j++) { // Loop to select the correct feature
        if(sel[j].innerHTML == feature_name) {
          sel[j].selected = "selected";
          feature = sel[j].value;
          break;
        }
      }
    }
    else if(child.className == "ida") { // ida
      ida = child.innerHTML.trim();
      child.innerHTML = '<input type="text" class="ida edit inputBoxStyle" id="ida_edit" value="'+ida+'" onkeydown="return enter_c(event);" />';
    }
    else if(child.className == "start") { // start
      start = child.innerHTML.trim();
      child.innerHTML = '<input type="text" class="start_end edit inputBoxStyle" id="start" value="'+start+'" onkeydown="enter_c(event);return input_check(event);" />';
    }
    else if(child.className == "end") { // end
      end = child.innerHTML.trim();
      child.innerHTML = '<input type="text" class="start_end edit inputBoxStyle" id="end" value="'+end+'" onkeydown="enter_c(event);return input_check(event);" />';
    }
  }

  /* Stores row information so we don't have to unnecessarily query the database.
      Will be compared later when a row is deactivated.*/ 
  PARAMS_OBJ.feature = feature;
  PARAMS_OBJ.feature_name = feature_name;
  PARAMS_OBJ.ida = ida;
  PARAMS_OBJ.start = start;
  PARAMS_OBJ.end = end;
}

// Dynamically change the annotation data
function activate_row(edit_button) {
  var row = edit_button.parentNode.parentNode;

  if(row.className.contains("active")) {
    deactivate_single_row(row);
    return;
  }

  // let's make it editable  
  deactivate_active_rows(); // First, make other rows inactive
  activate_row_helper(row.cells);

  // Something  // Focus the selected cell input
  row.className = row.className + " active";  // Adds the active component
}

function deactivate_single_row_helper(row) {
  var feature, feature_name, ida, start, end;
  var i, children = row.childNodes;
  
  // Gather the information
  for(i = 0;i < children.length; i++) {
    child = children[i];
    
    if(child.className == "feature_s") {  // feature
      feature = child.firstChild[child.firstChild.selectedIndex].value;
      feature_name = child.firstChild[child.firstChild.selectedIndex].innerHTML;
    }
    else if(child.className == "ida") { // ida
      ida = child.firstChild.value;
    }
    else if(child.className == "start") { // start
      start = child.firstChild.value;
    }
    else if(child.className == "end") { // end
      end = child.firstChild.value;
    }
  }

  var params_obj = new Object();
      params_obj.feature = feature;
      params_obj.feature_name = feature_name;
      params_obj.ida = ida;
      params_obj.start = start;
      params_obj.end = end;

  if(params_obj.feature == PARAMS_OBJ.feature &&
      params_obj.ida == PARAMS_OBJ.ida &&
      params_obj.start == PARAMS_OBJ.start &&
      params_obj.end == PARAMS_OBJ.end)
  {
    make_row_plain(row, params_obj);
    return;
  }


  // Commit the change in the database
  var geneId = document.getElementById("geneId").value;
  var id = row.id.match(/\d/g).join(""); // trim away the row value

  var xml;
  if (window.XMLHttpRequest) {  // code for IE7+, Firefox, Chrome, Opera, Safari
    xml = new XMLHttpRequest();
  }
  else {  // code for IE6, IE5
    xml = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      console.log(xml.responseText);
      if(xml.responseText == "success") {
        make_row_plain(row, params_obj);
      }
    }
  }
  xml.open("POST","_change_annotation.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  var params = "id="+id
              +"&geneId="+geneId
              +"&feature="+feature
              +"&ida="+ida
              +"&start="+start
              +"&end="+end;
  xml.send(params);  
}

// Deactivates the single, selected row
function deactivate_single_row(row) {
  if(!row.className.contains("active")) // Return if the row is inactive
    return;

  deactivate_single_row_helper(row);
}

// Deactivate all active rows
function deactivate_active_rows() {
  var table = document.getElementById("annotationTable");
  var rows = table.rows;
  var i;

  for(i = 0; i < rows.length; i++) {
    if(rows[i].className.contains("active"))
      deactivate_single_row(rows[i]);    
  }
}

// Adds a new row of annotation at the bottom of the table
function add_row(obj) {
  var table = document.getElementById("annotationTable");  
  var row = table.insertRow(-1);
  row.className = "a_row";
  row.id = "row"+obj.id;

    insert ='<td class="controls"><a href="#" title="remove this annotation" name="'+ obj.id +
                '" onclick="return remove_annotation(this);"> \
                <img src="../images/icons/trash_white.png" height="15" width="" /></a> \
                <a href="#" title="edit" onclick="activate_row(this)"> \
                  <img src="../images/icons/file_3_white.png" height="15" width="" /></a></td>'+
            '<td class="feature_s">'+obj.feature + '</td>' + 
            '<td class="ida">'+ obj.ida +'</td>' + 
            '<td class="start">'+ obj.start  +'</td>' +
            '<td class="end">'+ obj.end +'</td>';

  row.innerHTML = insert;
}

// Clears the input
function clear_input() {
  document.getElementById("ida").value = "";
  document.getElementById("ida").focus();
  document.getElementById("start").value = "";
  document.getElementById("end").value = "";

}

// Submits the new annotation using AJAX
function submit_annotation() {
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : new ActiveXObject("Microsoft.XMLHTTP");

  xml.open("POST","_submit_annotation.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var featureIndex = document.getElementById("feature").selectedIndex;
  
  var feature = document.getElementById("feature")[featureIndex].value;
    // feature = encodeURI(feature);
  var ida = document.getElementById("ida").value;
  var start = document.getElementById("start").value;
  var end = document.getElementById("end").value;
  var geneId = document.getElementById("geneId").value;
  
  var data = "geneId="+geneId
              +"&feature="+feature
              +"&ida="+ida
              +"&start="+start
              +"&end="+end;

  xml.send(data);

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      console.log(xml.responseText);
      if(xml.responseText == "repeat") {
        alert("The name is already in use!")
      }
      else if(xml.responseText.match(/\d/)) {
        var params_obj = new Object();
        params_obj.id = xml.responseText;
        params_obj.feature = document.getElementById("feature")[featureIndex].innerHTML;
        params_obj.ida = ida;
        params_obj.start = start;
        params_obj.end = end;
        add_row(params_obj);
        clear_input();
      }
    }
  }
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
  xml.open("POST","_remove_annotation.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var id = obj.name;
  var geneId = document.getElementById("geneId").value;
  
  var params = "geneId="+geneId
              +"&id="+id;
  xml.send(params);
}

/* Start up functions*/
