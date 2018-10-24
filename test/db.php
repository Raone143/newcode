<?php
ini_set('display_errors', 1);
$c = mysql_connect('localhost', 'root', '');
$d = mysql_select_db('test', $c);

$name = addcslashes($_GET['name'], "\x00, \n, \r, \x5C, \x27, \x22");
$upd_app_numbers = "update first set name= '".$name."' where id = '3'";
echo $upd_app_numbers."<br>";
$results = mysql_query($upd_app_numbers);

$sel = "SELECT * FROM first where id = 3";
$res = mysql_query($sel);
$ROW = mysql_fetch_assoc($res);
$k = addcslashes($ROW['name'], "\x00, \n, \r, \x5C, \x27, \x22");

$ins = mysql_query("INSERT INTO first(name, sign) VALUES('".$k."', 'core')");
?>