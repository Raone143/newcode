<?php
header("Content-type:text/plain");
$a = "1";
$b = 1;

echo $a."\n";
echo $b."\n";

if($a == $b) {
	echo "True\n";
}
echo "\n";
var_dump($b);
echo "\n";
if($a === (int)$b) {
	echo "True Next If";
}
else {
	
	echo "False";
}