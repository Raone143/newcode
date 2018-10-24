<?php 
$data = date('Y-m-d H:i:s').":";
$data .= "\n";

$fp = fopen('monsterlog.txt', 'a+');
fwrite($fp, $data);
fclose($fp);
?>