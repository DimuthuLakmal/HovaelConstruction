<?php

$mysql_host = 'localhost';
$mysqluser = 'root';
$mysqlpass = 'ijse';

$con = mysql_connect($mysql_host, $mysqluser, $mysqlpass);
$db = mysql_select_db('hovael');
if(!$con){
    die("Can't connect to server");
}
if(!$db){
    die("Can't connect to databases");
}

?>
