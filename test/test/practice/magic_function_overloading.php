<?php
class MethodTest
{
	
	//Inaccessable
	public function __call($name, $arguments)
	{
		if(count($arguments) == 1) {
			print_r($arguments);
			echo "<br>";
		}
		
		if(count($arguments) == 2) {
			echo "2 one;";
			print_r($arguments);
		}
	}

}

$Obj = new MethodTest();

//
$Obj->NewFile(array("User1", "Line"));

//Parameters 2
$Obj->NewFile(array("User1", "Line"), "It is for testing");