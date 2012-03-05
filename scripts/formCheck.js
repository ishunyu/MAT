function checkRegForm() {
  var firstName = document.getElementByName("input_register").firstName.value;
  var lastName = document.getElementByName("input_register").lastName.value;
  
  document.write(firstName+" "+lastName);
  
  return false;
}