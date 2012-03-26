function addRow() {
  var f = document.getElementById("specification_form");
  var num = 0;
  for(i = 0; i < f.length; i++) {
    if(f.childNodes[i] && f.childNodes[i].tagName == "DIV"){
      num++;
    }    
  }

  var op1 = document.createElement("option");
    op1.value = "promoter";
    op1.text = "promoter";
  var op2 = document.createElement("option");
    op2.value = "5URT";
    op2.text = "5'URT";
  var op3 = document.createElement("option");
    op3.value = "exon";
    op3.text = "Exon";
  var op4 = document.createElement("option");
    op4.value = "intron";
    op4.text = "Intron";
  var op5 = document.createElement("option");
    op5.value = "3URT";
    op5.text = "3'URT";
  var op6 = document.createElement("option");
    op6.value = "other";
    op6.text = "Other";
    
  var sel = document.createElement("select");
    sel.name = "type" + num;
    sel.className = "dna_type";
    sel.id = "type" + num;
    sel.appendChild(op1);
    sel.appendChild(op2);
    sel.appendChild(op3);
    sel.appendChild(op4);
    sel.appendChild(op5);
    sel.appendChild(op6);
    
  var textInput1 = document.createElement("input");
    textInput1.name = "start" + num;
    textInput1.id = "start" + num;
    textInput1.className = "dna_start_end";
    textInput1.type = "text" + num;
  var textInput2 = document.createElement("input");
    textInput2.name = "end" + num;
    textInput2.id = "end" + num;
    textInput2.className = "dna_start_end";
    textInput2.type = "text";
    
  var divA1 = document.createElement("div");
    divA1.className = "div_content_box_specification_A1";
  var divA2 = document.createElement("div");
    divA2.className = "div_content_box_specification_A2";
  var divA3 = document.createElement("div");
    divA3.className = "div_content_box_specification_A3";
    
  var divA = document.createElement("div");
    divA.className = "div_content_box_specification_row";
    
  divA1.appendChild(sel);
  divA2.appendChild(textInput1);
  divA3.appendChild(textInput2);
  
  divA.appendChild(divA1);
  divA.appendChild(divA2);
  divA.appendChild(divA3);
  
  var l = document.getElementById("submit_box");

  f.insertBefore(divA,l);
}

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