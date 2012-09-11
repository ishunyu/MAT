<?

$features_q = "SELECT features FROM $gene_table where id='$_SESSION[gene_id]'";
$features_r = mysql_query($features_q);
$features_a = mysql_fetch_assoc($features_r);
$features = json_decode(stripcslashes($features_a['features']), true);

unset($features['max_id']);

foreach($features as $key => $item) { ?>
  <option value="<? echo $key; ?>"><? echo $item; ?></option>
<? } ?>