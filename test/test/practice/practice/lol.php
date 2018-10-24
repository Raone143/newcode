<?php
class A {
	
	function users($a) {
		
		echo "Class A:";
	}
	
}


class B extends A {
	
	function users($a) {
		echo "Class B:";
	}
	
}
//Overriding
$Obj = new B();
$Obj->users($a);

//Class A
$AObj = new A(); 
$AObj->users($a);

//Class B
$BObj = new B();
$BObj->users($a);

