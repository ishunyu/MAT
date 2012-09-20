<?
$q_features = "SELECT *
               FROM $table_features";
$r_features = mysql_query($q_features);
while($features = mysql_fetch_assoc($r_features));

foreach($features as $feature) { ?>
  <option value="<? echo $feature['id']; ?>"><? echo $feature['name']; ?></option>
<? } ?>