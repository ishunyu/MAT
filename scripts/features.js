function remove_feature(cell) {
  var feature_id = cell.name;
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      console.log(xml.responseText);
      // location.reload();
    }
  }

  xml.open("POST","_remove_feature.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xml.send('feature_id='+feature_id);
}

function submit_feature() {
  var feature = document.getElementById('feature').value;
  var xml = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject("Microsoft.XMLHTTP"));

  xml.onreadystatechange=function() {
    if (xml.readyState==4 && xml.status==200) {
      // console.log(xml.responseText);
      location.reload();
    }
  }
  xml.open("POST","_submit_feature.php",true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xml.send('feature='+feature);
}