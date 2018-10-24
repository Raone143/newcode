<?php
$con = mysql_connect('localhost', 'root', '');
$db  = mysql_select_db('test', $con);

$query_ = "lock tables first write";
mysql_query($query_);
$query_ = "select * from test11";
sleep(10);
$query_ = "unlock tables";
mysql_query($query_);