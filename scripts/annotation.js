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
    else if(child.className == "show_feature") {  // feature
      child.innerHTML = params.feature_name;
    }
    else if(child.className == "name_gene") { // name_gene
      child.innerHTML = params.name_gene;
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
  var feature, feature_name, name_gene, start, end, i;

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
    else if(child.className == "show_feature") {  // feature
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
    else if(child.className == "name_gene") { // name_gene
      name_gene = child.innerHTML.trim();
      child.innerHTML = '<input type="text" class="name_gene edit inputBoxStyle" id="name_gene_edit" value="'+name_gene+'" onkeydown="return enter_c(event);" />';
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
  PARAMS_OBJ.name_gene = name_gene;
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
  var feature, feature_name, name_gene, start, end;
  var i, children = row.childNodes;
  
  // Gather the information
  for(i = 0;i < children.length; i++) {
    child = children[i];
    
    if(child.className == "show_feature") {  // feature
      feature = child.firstChild[child.firstChild.selectedIndex].value;
      feature_name = child.firstChild[child.firstChild.selectedIndex].innerHTML;
    }
    else if(child.className == "name_gene") { // name_gene
      name_gene = child.firstChild.value;
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
      params_obj.name_gene = name_gene;
      params_obj.start = start;
      params_obj.end = end;

  if(params_obj.feature == PARAMS_OBJ.feature &&
      params_obj.name_gene == PARAMS_OBJ.name_gene &&
      params_obj.start == PARAMS_OBJ.start &&
      params_obj.end == PARAMS_OBJ.end)
  {
    make_row_plain(row, params_obj);
    return;
  }


  // Commit the change in the database
  var id_gene = document.getElementById("id_gene").value;
  var id = row.id.match(/\d/g).join(""); // trim away the row value

  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));

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
              +"&id_gene="+id_gene
              +"&feature="+feature
              +"&name_gene="+name_gene
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
          '<td class="show_feature">'+obj.feature + '</td>' + 
          '<td class="name_annotation">'+ obj.name_annotation +'</td>' + 
          '<td class="start">'+ obj.start  +'</td>' +
          '<td class="end">'+ obj.end +'</td>';

  row.innerHTML = insert;
}

// Clears the input
function clear_input() {
  document.getElementById("name_annotation").value = "";
  document.getElementById("name_annotation").focus();
  document.getElementById("start").value = "";
  document.getElementById("end").value = "";

}

// Submits the new annotation using AJAX
function submit_annotation() {
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : new ActiveXObject("Microsoft.XMLHTTP");

  xml.open("POST","_submit_annotation.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var index_feature   = document.getElementById("id_feature").selectedIndex;
  var id_feature      = document.getElementById("id_feature")[index_feature].value;
  var scope_feature   = document.getElementById("id_feature")[index_feature].className;
  var name_annotation = document.getElementById("name_annotation").value;
  var start           = document.getElementById("start").value;
  var end             = document.getElementById("end").value;

  var data = "id_feature="+id_feature
              +"&scope_feature="+scope_feature
              +"&name_annotation="+name_annotation
              +"&start="+start
              +"&end="+end;

  xml.send(data);

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      var r = xml.responseText;
      console.log(r);
      if(r == "failed") {
        alert("There's something wrong with the input");
      }
      else if(r == "repeat") {
        alert("The name is already in use! Sorry!")
      }
      else if(r.match(/\d/)) {

        return;
        var params_obj = new Object();

        params_obj.id               = xml.responseText;
        params_obj.feature          = document.getElementById("feature")[index_feature].innerHTML;
        params_obj.name_annotation  = name_annotation;
        params_obj.start            = start;
        params_obj.end              = end;
        params_obj.scope_feature    = scope_feature;

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
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));

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
  var id_gene = document.getElementById("id_gene").value;
  
  var params = "id_gene="+id_gene
              +"&id="+id;
  xml.send(params);
}

/* Start up functions*/
