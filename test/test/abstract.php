<?php
abstract class abstclass
{
	public function fun3()
	{
		echo "i am a fun3". "<br /";	
	}
	abstract public function fun1();
	abstract public function fun4();
	public function fun2()
	{
		echo "i am a fun2". "<br /";	
	}
}
class human extends abstclass
{
	public function fun1()
	{
		echo "i am a abstract method implemented by fun1 in abstclass". "<br /";
	}
	public function fun4()
	{
		echo "i am a abstract method implemented by fun4 in abstclass". "<br /";
	}
}
// $obj = new abstclass(); can't create object in abstract class
// Fatal error: Cannot instantiate abstract class abstclass in E:\Xampp\htdocs\php_oops_topicwisepractice\abstract.php on line 7
$obj = new human();
$obj->fun1();
$obj->fun2();
$obj->fun3();
$obj->fun4();