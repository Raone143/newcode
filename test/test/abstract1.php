<?php
error_reporting(E_ALL);
abstract class test1
{
	function naaa()
	{
		echo "i am a fun3". "<br /";	
	}																																																																					
	function naaa1()
	{
		echo "i am a fun2". "<br /";	
	}
}
class shuman extends test1
{
	
}
// $obj = new abstclass(); can't create object in abstract class
// Fatal error: Cannot instantiate abstract class abstclass in E:\Xampp\htdocs\php_oops_topicwisepractice\abstract.php on line 7
$obj1 = new shuman();
$obj1->naaa();
$obj1->naaa1();

?>