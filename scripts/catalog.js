function show(link) {
  var thisRow = link.parentNode.parentNode;   // Gets the row
  var theSpan = document.getElementById("showcase"+thisRow.id);
  var delRow = document.getElementById("del"+thisRow.id);

  var table = thisRow.parentNode; // Gets the table
  

  if(theSpan) { // If sequence is already shown
    var deletionRowNumber;
    if(delRow)
      deletionRowNumber = thisRow.rowIndex + 2;
    else
      deletionRowNumber = thisRow.rowIndex + 1;
    
    
    table.deleteRow(deletionRowNumber);    
    return false;
  }
  else{
    var insertionRowNumber;
    if(delRow)
      insertionRowNumber = thisRow.rowIndex + 2;
    else
      insertionRowNumber = thisRow.rowIndex + 1;
    
    var newRow = table.insertRow(insertionRowNumber); // Inserts a new row below
    newRow.id = "showcase"+thisRow.id; // Debug
    
    var td_1 = document.createElement("td");  // Creates a cell
    td_1.colSpan = 2;
    
    var div_1 = document.createElement("div");  // Creates the div for sequence
    div_1.id = "showcaseDiv"+thisRow.id; // Adds id
    div_1.className = "showcase";
    
    newRow.appendChild(td_1); 
    td_1.appendChild(div_1); // Inserts the div in the cell
    
    sendAjaxForSequence(thisRow.id); // Ajax for the sequence
    
    return false;
  }
}

// Sends the Ajax request
function sendAjaxForSequence(geneId) {  
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function() { // the Call back function
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      var responseText = xmlhttp.responseText;
      var div_outer = document.getElementById("showcaseDiv"+geneId);
      div_outer.innerHTML = responseText;
    }
  }
  
  var POSTMessage = "geneId="+geneId;
  
  xmlhttp.open("POST","_show.php",true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send(POSTMessage);
}

function del(link) {  // Adds the delete confirmation message
  var thisRow = link.parentNode.parentNode;   // Gets the row
  var table = thisRow.parentNode; // Gets the table
  
  var delRow = document.getElementById("del"+thisRow.id); // Gets the delete msg row
  
  if(delRow) { // If the delete msg row is there, "hide" it
    table.deleteRow(thisRow.rowIndex+1);    
    return false;
  }
  else {  // If the delete msg row isn't there, make it
    var newRow = table.insertRow(thisRow.rowIndex+1); // Inserts a new row below
    newRow.id= "del"+thisRow.id;  // Creates id 
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
  var thisRow = link.parentNode.parentNode;   // Gets the row
  var id = thisRow.id.match(/\d/g); // Matches the numbers
  id = id.join(""); // Joins the number to form the correct id
  
  sendAjaxForDeletion(id);  // Ajax for deletion
  
  return false;
}


function sendAjaxForDeletion(geneId) {  
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
        var row = document.getElementById(geneId);  // Gets the dna row
        var showcase = document.getElementById("showcase"+geneId);  // Gets the showcase row
        var del = document.getElementById("del"+geneId);  // Gets the del row
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
  
  var POSTMessage = "geneId="+geneId;
  
  xmlhttp.open("POST","_delete.php",true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send(POSTMessage);
}



function del_cancel(link) {
  var thisRow = link.parentNode.parentNode;   // Gets the row
  var table = thisRow.parentNode; // Gets the table
  table.deleteRow(thisRow.rowIndex);  
  return false;
}