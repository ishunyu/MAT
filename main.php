<?php
include "dbConfig.php";
session_start();

$query = "SELECT * FROM $tableName WHERE Account='$_SESSION[accountName]'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

?>


<html>

<body>
Welcome <?php echo $row['Firstname']; ?>
</br>
<a href="/geneMutation/logout.php">Logout</a>
</body>
</html>
