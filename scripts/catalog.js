function show(link) {
  var row_this = link.parentNode.parentNode;   // Gets the row
  var span_gene = document.getElementById("showcase"+row_this.id);
  var delRow = document.getElementById("del"+row_this.id);

  var table = row_this.parentNode; // Gets the table

  var number_row = delRow ? (row_this.rowIndex + 2) : (row_this.rowIndex + 1);

  if(span_gene) { // If sequence is already shown    
    
    table.deleteRow(number_row);    
    return false;
  }
  else{ 
    
    var row_new = table.insertRow(number_row); // Inserts a new row below
    row_new.id = "showcase"+row_this.id; // Debug
    
    var td_1 = document.createElement("td");  // Creates a cell
    td_1.colSpan = 2;
    
    var div_1 = document.createElement("div");  // Creates the div for sequence
    div_1.id = "showcaseDiv"+row_this.id; // Adds id
    div_1.className = "showcase";
    
    row_new.appendChild(td_1); 
    td_1.appendChild(div_1); // Inserts the div in the cell
    
    send_ajax_for_gene(row_this.id); // Ajax for the sequence
    
    return false;
  }
}

// Sends the Ajax request
function send_ajax_for_gene(id_gene) {  
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));
  
  xml.onreadystatechange=function() { // the Call back function
    if (xml.readyState==4 && xml.status==200) {
      var responseText = xml.responseText;
      var div_outer = document.getElementById("showcaseDiv"+id_gene);
      div_outer.innerHTML = responseText;
    }
  }
  
  var data = "id_gene="+id_gene;
  
  xml.open("POST","_show.php",true);
  xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xml.send(data);
}

function del(link) {  // Adds the delete confirmation message
  var row_this = link.parentNode.parentNode;   // Gets the row
  var table = row_this.parentNode; // Gets the table
  
  var delRow = document.getElementById("del"+row_this.id); // Gets the delete msg row
  
  if(delRow) { // If the delete msg row is there, "hide" it
    table.deleteRow(row_this.rowIndex+1);    
    return false;
  }
  else {  // If the delete msg row isn't there, make it
    var newRow = table.insertRow(row_this.rowIndex+1); // Inserts a new row below
    newRow.id= "del"+row_this.id;  // Creates id 
    newRow.className = "del"; // Creates class
    
    var td_1 = document.createElement("td");  // Creates a cell
    td_1.colSpan = 2; // Make it span 2 rows
    td_1.style.textAlign="right";
    td_1.innerHTML="<span class=\"confirmMsg\">Are you sure?</span> <a href=\"\" onclick=\"return del_confirm(this);\">Yes</a> <a href=\"\" onclick=\"return del_cancel(this);\">No</a>";
    td_1.style.paddingRight="20px";
    
    newRow.appendChild(td_1); // Inserts the cell
    
    return false;
  }

}

function del_confirm(link) {
  var row_this = link.parentNode.parentNode;   // Gets the row
  var id = row_this.id.match(/\d/g); // Matches the numbers
  id = id.join(""); // Joins the number to form the correct id
  
  send_ajax_for_deletion(id);  // Ajax for deletion
  
  return false;
}


function send_ajax_for_deletion(id_gene) {  
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function() { // the Call back function
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      var responseText = xmlhttp.responseText;
      //alert(responseText);
        //return false;
      
      if(responseText == true) {
        var row = document.getElementById(id_gene);  // Gets the dna row
        var showcase = document.getElementById("showcase"+id_gene);  // Gets the showcase row
        var del = document.getElementById("del"+id_gene);  // Gets the del row
        var table = row.parentNode; // Gets the table
        
               
        if(showcase) { // Deletes the showcase row
          table.deleteRow(showcase.rowIndex);
        }
        if(del) { // Deletes the deletion row
          table.deleteRow(del.rowIndex);
        }
        table.deleteRow(row.rowIndex);  // Deletes the sequence row
      }
      else
        alert(responseText);
    }
  }
  
  var POSTMessage = "id_gene="+id_gene;
  
  xmlhttp.open("POST","_delete.php",true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send(POSTMessage);
}



function del_cancel(link) {
  var row_this = link.parentNode.parentNode;   // Gets the row
  var table = row_this.parentNode; // Gets the table
  table.deleteRow(row_this.rowIndex);  
  return false;
}