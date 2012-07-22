var count = 3 
var redirect="../catalog/catalog.php"  
  
function countDown(){  
 if (count <= 1){  
  window.location = redirect;  
 }else{  
  count--;  
  document.getElementById("timer").innerHTML = "This page will redirect in "+count+" seconds."  
  setTimeout("countDown()", 1000)  
 }  
} 