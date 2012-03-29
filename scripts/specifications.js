// ----- Specifications -----

// Adding a row at the bottom of the specifications page
function addRow() {
  // RETRIEVE NUMBER OF ROWS
  var f = document.getElementById("specification_form");
  var num = 0;
  for(i = 0; i < f.length; i++) {
    if(f.childNodes[i] && f.childNodes[i].tagName == "DIV"){
      num++;
    }    
  }
  
  // OPTIONS
  var op1 = document.createElement("option");
    op1.value = "1";
    op1.text = "m7G Cap";
  var op2 = document.createElement("option");
    op2.value = "1";
    op2.text = "promoter";
  var op3 = document.createElement("option");
    op3.value = "1";
    op3.text = "5'URT";
  var op4 = document.createElement("option");
    op4.value = "1";
    op4.text = "Exon";
  var op5 = document.createElement("option");
    op5.value = "0";
    op5.text = "Intron";
  var op6 = document.createElement("option");
    op6.value = "1";
    op6.text = "3'URT";
  var op7 = document.createElement("option");
    op7.value = "1";
    op7.text = "Poly(A) tail";
  var op8 = document.createElement("option");
    op8.value = "1";
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
  
  var previousSelectBox = document.getElementById("type"+(num-1));
  sel.selectedIndex = previousSelectBox.selectedIndex+1;
  
  // START AND END MARKERS
  var textInput1 = document.createElement("input");
    textInput1.onkeydown = function(){return checkInputForNumber(event);};
    textInput1.name = "start" + num;
    textInput1.id = "start" + num;
    textInput1.className = "geneStartAndEndMarker inputBoxStyle";
    textInput1.type = "text" + num;
  var textInput2 = document.createElement("input");
    textInput2.onkeydown = function(){return checkInputForNumber(event);};
    textInput2.name = "end" + num;
    textInput2.id = "end" + num;
    textInput2.className = "geneStartAndEndMarker inputBoxStyle";
    textInput2.type = "text";
    
  var checkBox = document.createElement("input");
    checkBox.name = "keep" + num;
    checkBox.id = "keep" + num;
    checkBox.className = "geneCheckbox";
    checkBox.type = "checkbox";
    checkBox.checked = true;
  
  // ROW ELEMENTS
  var divA1 = document.createElement("div");
    divA1.className = "specRowA1";
  var divA2 = document.createElement("div");
    divA2.className = "specRowA2";
  var divA3 = document.createElement("div");
    divA3.className = "specRowA3";
  var divA4 = document.createElement("div");
    divA4.className = "specRowA4";
    
  var divA = document.createElement("div");
    divA.className = "specRow";
    
  divA1.appendChild(sel);
  divA2.appendChild(textInput1);
  divA3.appendChild(textInput2);
  divA4.appendChild(checkBox);
  
  divA.appendChild(divA1);
  divA.appendChild(divA2);
  divA.appendChild(divA3);
  divA.appendChild(divA4);
  
  var l = document.getElementById("submit_box");

  f.insertBefore(divA,l);
}

// Deletes the last row of specifications
function delRow(){
  // GET THE NUMBER OF ROWS
  var f = document.getElementById("specification_form");
  var num = 0;
  for(i = 0; i < f.length; i++) {
    if(f.childNodes[i] && f.childNodes[i].tagName == "DIV"){
      num++;
    }    
  }
  
  // DELETES THE LAST ROW
  if(num > 2) {
    var l = document.getElementById("submit_box");
    var d = l.previousSibling;
    
    //alert(d);
    f.removeChild(d);
  }
}

// Automtically checks/unchecks the keep box depending on the type of gene
function checkCheckbox(row) {
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

  if((keyStroke.keyCode < 48 || keyStroke.keyCode > 58) && keyStroke.keyCode != 8 && keyStroke.keyCode != 46) {
     if (keyStroke.preventDefault) {
         keyStroke.preventDefault();
     }    
    return false;
  }
}

// Clearing all the entries
function clearRows() {
  var x = document.getElementsByTagName("input");
  
  for(i = 0; i < x.length; i++) {
    if(x[i].type == "text") {
      x[i].value = "";
    }
  }
}



