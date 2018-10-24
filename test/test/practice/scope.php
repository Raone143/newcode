<?php
class LoadBalance {

	static $test = "once";
	static function abc() {
		echo "Function Call";
	}

	
	
	
}



//$k = (static) $obj;
/*
for ($i = 0; $i < 10; $i++) {
	static $k = 0;
	echo "$i-$k<br>";
	$k++;
} */

// Loop
// Class
//LoadBalance::abc();
echo LoadBalance::$test;