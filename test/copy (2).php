<?php
$a = "9 3432 3234555 9-8 483--";
$MPhone = str_replace(array("-", " "), "", $a);

echo $MPhone."<br>";
echo substr($MPhone, -10);