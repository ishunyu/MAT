<?php
require_once "../headers/variables.php";
require_once '../classes/FEATURES.php';

/* Connecting to mysql */
  $connection = mysql_connect($host, $account, $password)or die("Cannot connect to SQL");

/* Create out database */
  mysql_query($q_database) or die("Database $db could not be created.");

/* Connect to our datatbase */
  mysql_select_db($db)
    or die("Cannot establish connection with database");

foreach ($queries as $query) {
  //echo $query.'<br>';
  mysql_query($query);
}

/* Adding the features into the global feature database */
foreach ($a_features as $key => $value) {
  $q_add_features = 
    "INSERT INTO $table_features_global(id, name) VALUES(NULL, '".mysql_real_escape_string($value)."')";
  mysql_query($q_add_features);
}

/* Redirect to main page */
$path_redirect =
  ($_SERVER["HTTP_HOST"] == "localhost") ?
  "location:https://localhost/mat/index.php" : "location:http://vis.cs.ucdavis.edu/~yus/mat/index.php";
//header($path_redirect);

?>