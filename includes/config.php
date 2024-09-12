<?php
define('DB_SERVER','localhost');
define('DB_USER','id22079091_loginsystem_1');
define('DB_PASS' ,'Aadil@7319777540');
define('DB_NAME', 'id22079091_loginsystem');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }

?>

