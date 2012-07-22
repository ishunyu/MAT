// ----- Annotate -----
function createSelect(num) {
  // OPTIONS
  var op1 = document.createElement("option");
    op1.value = "2";
    op1.text = "m7G Cap";
  var op2 = document.createElement("option");
    op2.value = "3";
    op2.text = "promoter";
  var op3 = document.createElement("option");
    op3.value = "4";
    op3.text = "5'URT";
  var op4 = document.createElement("option");
    op4.value = "1";
    op4.text = "Exon";
  var op5 = document.createElement("option");
    op5.value = "0";
    op5.text = "Intron";
  var op6 = document.createElement("option");
    op6.value = "5";
    op6.text = "3'URT";
  var op7 = document.createElement("option");
    op7.value = "6";
    op7.text = "Poly(A) tail";
  var op8 = document.createElement("option");
    op8.value = "99";
    op8.text = "Other";
  
  // SELECT
  var sel = document.createElement("select");
    sel.name = "type" + num;
    sel.className = "geneType";
    sel.id = "type" + num;
    sel.onchange = function(){checkCheckbox(this);};
    
    sel.appendChild(op1);
    sel.appendChild(op2);
    sel.appendChild(op3);
    sel.appendChild(op4);
    sel.appendChild(op5);
    sel.appendChild(op6);
    sel.appendChild(op7);
    sel.appendChild(op8);
  
  return sel;
}

// Adding a row at the bottom of the specifications page
function addRow() {
  // RETRIEVE NUMBER OF ROWS
  var table = document.getElementById("annotationTable");
  var num = table.rows.length;
  num = num - 1;
  var row = table.insertRow(num);


  //if(num >= 50) return;
  var sel = createSelect(num);  
  
  var previousSelectBox = document.getElementById("type"+(num-1));
  sel.selectedIndex = (previousSelectBox.selectedIndex >= 7) ? 7 : previousSelectBox.selectedIndex+1;
  
  // START AND END MARKERS
  var id = document.createElement("input");
    id.name = "feature" + num;
    id.id = "feature" + num;
    id.className = "idInputBox inputBoxStyle";
    id.type = "text";
  var start = document.createElement("input");
    start.onkeydown = function(){return checkInputForNumber(event);};
    start.name = "start" + num;
    start.id = "start" + num;
    start.className = "geneStartAndEndMarker inputBoxStyle";
    start.type = "text";
  var end = document.createElement("input");
    end.onkeydown = function(){return checkInputForNumber(event);};
    end.name = "end" + num;
    end.id = "end" + num;
    end.className = "geneStartAndEndMarker inputBoxStyle";
    end.type = "text";
    
  var checkBox = document.createElement("input");
    checkBox.name = "keep" + num;
    checkBox.id = "keep" + num;
    checkBox.className = "geneCheckbox";
    checkBox.type = "checkbox";
    checkBox.checked = (sel.options[sel.selectedIndex].value == 0) ? false : true;
  
  // ROW ELEMENTS
  var featureCell = row.insertCell(0);
  var idCell = row.insertCell(1);
  var startCell = row.insertCell(2);
  var endCell = row.insertCell(3);
  var keepCell = row.insertCell(4);
    
    
  featureCell.appendChild(sel);
  idCell.appendChild(id);
  startCell.appendChild(start);
  endCell.appendChild(end);
  keepCell.appendChild(checkBox);

  return false;
}

// Deletes the last row of specifications
function delRow(){
  // GET THE NUMBER OF ROWS
  var table = document.getElementById("annotationTable");
  var num = table.rows.length;

  if(num>3)
    table.deleteRow(num - 2);
  
  return false;
}

// Automtically checks/unchecks the keep box depending on the type of gene
function checkCheckbox(row) {
  return false;
  var keepId = "keep"+row.id.substr(row.id.search(/\d/)); // Getting the id of the checkbox
  var selection = row.options[row.selectedIndex].value; // Getting the value of the dropdown list item

  var keep = document.getElementById(keepId); // Getting the checkbox corresponding to the row
  
  // Perform the check/unchecked operation
  if(selection == "0") {
    keep.checked = false;
  }
  else if(selection == "1") {
    keep.checked = true;
  }
  else {
    document.write("Shouldn't be here");
  }
}

// Prevents non-numbers from typing
function checkInputForNumber(keyStroke) {
  //alert(keyStroke.keyCode);

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

// Clearing all the entries
function clearRows() {
  var x = document.getElementsByTagName("input");
  
  for(var i = 0; i < x.length; i++) {
    if(x[i].type == "text") {
      x[i].value = "";
    }
  }
}

function pressedKey(keyStroke) {
  if(keyStroke.shiftKey && keyStroke.keyCode == "A".charCodeAt(0)) {
    addRow();
  }  
  else if(keyStroke.shiftKey && keyStroke.keyCode == "D".charCodeAt(0)) {
    delRow();
  }  
  else if(keyStroke.shiftKey && keyStroke.keyCode == "C".charCodeAt(0)) {
    clearRows();
  }
}

document.onkeydown = function(){pressedKey(window.event);};

