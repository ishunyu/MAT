/* annotation.js */
var bool_activate = true;

function get_id_annotation(row) {
  return row.id.substring(row.id.indexOf("_") + 1);
}
// Used for submitting
function enter(keyStroke) {
  if(keyStroke.keyCode == 13)
    submit_annotation();
}

// Used for while editing
function enter_c(keyStroke) {
  if(keyStroke.keyCode == 13)
    deactivate_rows_active(null);
}

// Prevents non-numbers from typing
function input_check(keyStroke) {

}

/* Commit the change on the front end */
function make_row_plain(id_annotation, obj_annotation) {
  $("img_edit_"+id_annotation).src = "../images/icons/file_3_white.png";
  $("feature_"+id_annotation).innerHTML = obj_annotation.name_feature;
  $("name_annotation_"+id_annotation).innerHTML = obj_annotation.name_annotation;
  $("start_"+id_annotation).innerHTML = obj_annotation.start;
  $("end_"+id_annotation).innerHTML = obj_annotation.end;

  // Delete the active class name
  var index_active = $("row_"+id_annotation).className.indexOf("active");
  $("row_"+id_annotation).className = $("row_"+id_annotation).className.substr(0, index_active).trim();
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
    '<input type="text" class="name_annotation edit inputBoxStyle" id="edit_name_annotation_'+id_annotation+'" value="'+name_annotation+'" />';
  $("start_"+id_annotation).innerHTML =
    '<input type="text" class="start_end edit inputBoxStyle" id="edit_start_'+id_annotation+'" value="'+start+'" onkeydown="enter_c(event);return input_check(event);" />';
  $("end_"+id_annotation).innerHTML =
    '<input type="text" class="start_end edit inputBoxStyle" id="edit_end_'+id_annotation+'" value="'+end+'" onkeydown="enter_c(event);return input_check(event);" />';

  /* Change the feature to the correct one */

  var children = $("edit_feature_"+id_annotation).children;
  for(var i = 0; i < children.length; i++) {
    if(children[i].innerHTML.trim() == feature_original) {
      children[i].selected = "selected";
    }
  }  
}

/* Activate row so user can change the annotation data */
function activate_row(button_edit) {
  var row = button_edit.parentNode.parentNode;
  var id_annotation = get_id_annotation(row);  /* Retrieves the id */

  if(!bool_activate && !row.className.contains("active"))  /* Some other row is still activated */
    return;

  if(row.className.contains("active")) {
    deactivate_row(row);
    bool_activate = true;
    return;
  }

  /* Let's make it editable */  
  deactivate_rows_active(); // First, make other rows inactive
  helper_activate_single_row(id_annotation);
  bool_activate = false;

  row.className = row.className + " active";  // Adds the active component
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

  // Commit the change in the database
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      var r = xml.responseText;

      if(r == "failed") {
        alert("There's something wrong with the input");
      }
      else if(r == "repeat") {
        alert("The name is already in use! Sorry!");
      }
      else {
        var obj_annotation = new Object();
        obj_annotation.name_feature = name_feature;
        obj_annotation.name_annotation = name_annotation;
        obj_annotation.start = edit_start;
        obj_annotation.end = edit_end;

        make_row_plain(id_annotation, obj_annotation);
      }
    }
  }
  xml.open("POST","_change_annotation.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  var params = "id_annotation="+id_annotation
              +"&id_feature="+id_feature
              +"&scope_feature="+scope_feature
              +"&name_annotation="+name_annotation
              +"&start="+edit_start
              +"&end="+edit_end;
  xml.send(params);  
}

/* Deactivates the single, selected row */
function deactivate_row(row) {
  if(!row.className.contains("active")) /* Return if the row is inactive */
    return;

  return helper_deactivate_row(get_id_annotation(row));
}

/* Deactivate all active rows */
function deactivate_rows_active() {
  var table = $("annotationTable");
  var rows = table.rows;

  for(var i = 0; i < rows.length; i++) {
    if(rows[i].className.contains("active"))
      deactivate_row(rows[i]);    
  }
}

// Adds a new row of annotation at the bottom of the table
function add_row(obj) {
  var table = $("annotationTable");  
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
  $("name_annotation").value = "";
  $("name_annotation").focus();
  $("start").value = "";
  $("end").value = "";

}

// Submits the new annotation using AJAX
function submit_annotation() {
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : new ActiveXObject("Microsoft.XMLHTTP");

  xml.open("POST","_submit_annotation.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var index_feature   = $("id_feature").selectedIndex;
  var id_feature      = $("id_feature")[index_feature].value;
  var scope_feature   = $("id_feature")[index_feature].className;
  var name_annotation = $("name_annotation").value;
  var start           = $("start").value;
  var end             = $("end").value;

  var data_post = "id_feature="+id_feature
              +"&scope_feature="+scope_feature
              +"&name_annotation="+name_annotation
              +"&start="+start
              +"&end="+end;

  xml.send(data_post);

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
      else {
        return;
        location.reload();
      }
    }
  }
}

// Removes a row from the table
function remove_row(id_annotation) {
  var row = $("row_"+id_annotation);
  var t = $("annotationTable");

  t.deleteRow(row.rowIndex);
}

// Removes selected annotation using AJAX
function remove_annotation(obj) {
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));
  
  xml.open("POST","_remove_annotation.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var id_annotation = get_id_annotation(obj.parentNode.parentNode);
  
  var data_post = "id_annotation="+id_annotation;
  xml.send(data_post);

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {

      if(xml.responseText == "") {
        remove_row(id_annotation);
      }
      else {
        alert("Removing annotation unsuccessful.")
      }
    }
  }
}

/* Start up functions*/
window.onload = function() { $('name_annotation').focus(); }