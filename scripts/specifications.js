// ----- Specifications -----

// Adding a row at the bottom of the specifications page
function addRow() {
  var f = document.getElementById("specification_form");
  var num = 0;
  for(i = 0; i < f.length; i++) {
    if(f.childNodes[i] && f.childNodes[i].tagName == "DIV"){
      num++;
    }    
  }
  
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
    
  var sel = document.createElement("select");
    sel.name = "type" + num;
    sel.className = "gene_type";
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
    
  var textInput1 = document.createElement("input");
    textInput1.onkeydown = function(){return checkNumberInput(event);};
    textInput1.name = "start" + num;
    textInput1.id = "start" + num;
    textInput1.className = "gene_start_end";
    textInput1.type = "text" + num;
  var textInput2 = document.createElement("input");
    textInput2.onkeydown = function(){return checkNumberInput(event);};
    textInput2.name = "end" + num;
    textInput2.id = "end" + num;
    textInput2.className = "gene_start_end";
    textInput2.type = "text";
    
  var checkBox = document.createElement("input");
    checkBox.name = "keep" + num;
    checkBox.id = "keep" + num;
    checkBox.className = "gene_keep";
    checkBox.type = "checkbox";
    checkBox.checked = true;
    
  var divA1 = document.createElement("div");
    divA1.className = "div_content_box_specification_A1";
  var divA2 = document.createElement("div");
    divA2.className = "div_content_box_specification_A2";
  var divA3 = document.createElement("div");
    divA3.className = "div_content_box_specification_A3";
  var divA4 = document.createElement("div");
    divA4.className = "div_content_box_specification_A4";
    
  var divA = document.createElement("div");
    divA.className = "div_content_box_specification_row";
    
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

// Beta add row function
function addRowTest() {
  var f = document.getElementById("specification_form");
  var specRow = document.getElementById("specRow");
  var newRow = specRow.cloneNode(true);
  
  
  
  var l = document.getElementById("submit_box");

  f.insertBefore(newRow,l);
}

// Deletes the last row of specifications
function delRow(){
  var f = document.getElementById("specification_form");
  var num = 0;
  for(i = 0; i < f.length; i++) {
    if(f.childNodes[i] && f.childNodes[i].tagName == "DIV"){
      num++;
    }    
  }
  
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





