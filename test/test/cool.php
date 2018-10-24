<?php
abstract class abc{
	
	function test() {
		echo "ER";
	}
	
	function abca() {
		echo "EREE";
	}
}
class bbc extends abc {
	
	
	
}

$bbc = new bbc();
$bbc->test();
$bbc->abca();