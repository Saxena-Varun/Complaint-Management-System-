<?php
// Load mysqli compatibility shim for PHP 7+/8+ (project uses legacy mysql_* functions)
require_once dirname(__DIR__, 2) . '/mysql_shim.php';

$mysql_hostname = "127.0.0.1:3307";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "cms";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");

?>