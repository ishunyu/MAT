/* annotation.js */
var bool_activate = true; /* Used for editing */

/* Submits the new annotation using AJAX */
function submit_annotation() {
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : new ActiveXObject("Microsoft.XMLHTTP");

  xml.open("POST","_submit_annotation.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var index_feature   = $("id_feature").selectedIndex;
  var id_feature      = $("id_feature")[index_feature].value;
  var scope_feature   = $("id_feature")[index_feature].className;
  var name_annotation = $("name_annotation").value.trim();
  var start           = $("start").value.trim();
  var end             = $("end").value.trim();

  var data_post = "id_feature="+id_feature
              +"&scope_feature="+scope_feature
              +"&name_annotation="+name_annotation
              +"&start="+start
              +"&end="+end;

  xml.send(data_post);

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      if(process_xml_response(xml.responseText)) {
        location.reload();
      }
    }
  }
}

/* Removes selected annotation using AJAX */
function remove_annotation(obj) {
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));
  
  xml.open("POST","_remove_annotation.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var id_annotation = get_id(obj.parentNode.parentNode);
  
  var data_post = "id_annotation="+id_annotation;
  xml.send(data_post);

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      //console.log(r);
      if(process_xml_response(xml.responseText)) {
        remove_row(id_annotation);
      }
    }
  }
}

/* Removes a row from the table */
function remove_row(id_annotation) {
  var row = $("row_"+id_annotation);
  var t = $("annotationTable");

  t.deleteRow(row.rowIndex);
}

/* Activate row so user can change the annotation data */
function activate_row(button_edit) {
  var row = button_edit.parentNode.parentNode;
  var id_annotation = get_id(row);  /* Retrieves the id */

  if(!bool_activate && !row.className.contains("active"))  /* Some other row is still activated */
    return;

  if(row.className.contains("active")) {
    deactivate_row(row);
    bool_activate = true;
    return;
  }

  /* Let's make it editable */  
  deactivate_rows_active(); /* First, make other rows inactive */
  helper_activate_single_row(id_annotation);
  bool_activate = false;

  row.className = row.className + " active";  /* Adds the active component */
}

function helper_activate_single_row(id_annotation) {
  var feature_original = $("feature_"+id_annotation).innerHTML.trim(); // Store the original feature
  var name_annotation = $("name_annotation_"+id_annotation).innerHTML.trim();
  var start = $("start_"+id_annotation).innerHTML.trim();
  var end = $("end_"+id_annotation).innerHTML.trim();

  /* Change the the row to editable */
  $("img_edit_"+id_annotation).src = "../images/icons/tick_2_white.png"; // edit button -> confirm button  
  $("feature_"+id_annotation).innerHTML =
    '<select class="feature edit" id="edit_feature_'+id_annotation+'" onchange="">'+$('id_feature').innerHTML+'</select>';
  $("name_annotation_"+id_annotation).innerHTML =
    '<input type="text" class="name_annotation edit inputBoxStyle" id="edit_name_annotation_'+id_annotation+'" value="'+name_annotation+'" onkeydown="keyboard(event, deactivate_rows_active)"/>';
  $("start_"+id_annotation).innerHTML =
    '<input type="text" class="start_end edit inputBoxStyle" id="edit_start_'+id_annotation+'" value="'+start+'" onkeydown="keyboard(event, deactivate_rows_active)" />';
  $("end_"+id_annotation).innerHTML =
    '<input type="text" class="start_end edit inputBoxStyle" id="edit_end_'+id_annotation+'" value="'+end+'" onkeydown="keyboard(event, deactivate_rows_active)" />';

  /* Change the feature to the correct one */

  var children = $("edit_feature_"+id_annotation).children;
  for(var i = 0; i < children.length; i++) {
    if(children[i].innerHTML.trim() == feature_original) {
      children[i].selected = "selected";
    }
  }  
}

/* Deactivate all rows */
function deactivate_rows_active() {
  var table = $("annotationTable");
  var rows = table.rows;

  for(var i = 0; i < rows.length; i++) {
    if(rows[i].className.contains("active"))
      deactivate_row(rows[i]);    
  }
}

/* Deactivates a row */
function deactivate_row(row) {
  if(!row.className.contains("active")) /* Return if the row is inactive */
    return;

  return helper_deactivate_row(get_id(row));
}

function helper_deactivate_row(id_annotation) {
  var id_feature, scope_feature, name_feature, name_annotation, edit_start, edit_end;
  
  /* Gather the information */
  id_feature = $("edit_feature_"+id_annotation)[$("edit_feature_"+id_annotation).selectedIndex].value;
  scope_feature = $("edit_feature_"+id_annotation)[$("edit_feature_"+id_annotation).selectedIndex].className;
  name_feature = $("edit_feature_"+id_annotation)[$("edit_feature_"+id_annotation).selectedIndex].innerHTML.trim();
  name_annotation = $("edit_name_annotation_"+id_annotation).value.trim();
  edit_start = $("edit_start_"+id_annotation).value.trim();
  edit_end = $("edit_end_"+id_annotation).value.trim();

  /* Commit the change in the database */
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));  

  xml.open("POST","_edit_annotation.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  var data_post = "id_annotation="+id_annotation
              +"&id_feature="+id_feature
              +"&scope_feature="+scope_feature
              +"&name_annotation="+name_annotation
              +"&start="+edit_start
              +"&end="+edit_end;
  xml.send(data_post);

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      if(process_xml_response(xml.responseText)) {
        var obj_annotation = new Object();
        obj_annotation.name_feature = name_feature;
        obj_annotation.name_annotation = name_annotation;
        obj_annotation.start = edit_start;
        obj_annotation.end = edit_end;

        make_row_plain(id_annotation, obj_annotation);
      }
    }
  }
}

/* Commit the change on the front end */
function make_row_plain(id_annotation, obj_annotation) {
  /* Changes the table cells */
  $("img_edit_"+id_annotation).src = "../images/icons/file_3_white.png";
  $("feature_"+id_annotation).innerHTML = obj_annotation.name_feature;
  $("name_annotation_"+id_annotation).innerHTML = obj_annotation.name_annotation;
  $("start_"+id_annotation).innerHTML = obj_annotation.start;
  $("end_"+id_annotation).innerHTML = obj_annotation.end;

  /* Delete the active class name */
  var index_active = $("row_"+id_annotation).className.indexOf("active");
  $("row_"+id_annotation).className = $("row_"+id_annotation).className.substr(0, index_active).trim();
}

/* Start up functions*/
window.onload = function() { $('name_annotation').focus(); }