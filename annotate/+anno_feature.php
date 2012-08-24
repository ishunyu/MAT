<?php
// Gets the feature
$featuresQ =
  "SELECT features
   FROM $geneListTableName
   WHERE id=$geneId";


$featuresQ = mysql_query($featuresQ);
$featuresQ = mysql_fetch_assoc($featuresQ);    
$features = $featuresQ['features']; // Gets the spec portion of the query
$features = json_decode($features, true);  // Turns json into associative array




?>