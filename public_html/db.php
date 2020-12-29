<?php
// Provide more information if something is wrong with your code: (currently disabled, for use in debugging)
//error_reporting(-1);
//ini_set('display_errors', 'On');
// Settings used to connect to the database:
$db_host = 'mysql.cs.nott.ac.uk';
$db_user = 'psyam12';
$db_pass = 'NRXPBT';
$db_name = 'psyam12';
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_errno) echo "failed to connect to database";

$con=mysql_connect("mysql.cs.nott.ac.uk","psyam12","NRXPBT");
$db_found = mysql_select_db("psyam12");
?>