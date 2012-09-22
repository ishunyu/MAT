/* feature.js */
function remove_feature(cell) {
  var id_feature_user = cell.name.substring(cell.name.indexOf("_") + 1);  /* Gets the id only */
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));

  
  xml.open("POST","_remove_feature.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xml.send('id_feature_user='+id_feature_user);

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      console.log(xml.responseText);
      if(xml.responseText == 'used') {
        alert("Can't delete because it's in use! Sorry!");
        return;
      }
      location.reload();
    }
  }

}

function submit_feature() {
  var feature_user_new = $('feature_user_new').value;
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      //console.log(xml.responseText);
      if(xml.responseText == 'repeat') {
        alert("Can't add this because there's another feature with the same name! Sorry!");
        return;
      }
      location.reload();
    }
  }
  xml.open("POST","_submit_feature.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xml.send('feature_user_new='+feature_user_new);
}