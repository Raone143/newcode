<?php
/**
 * Define MyClass
 */
class MyClass
{
    function printHello(string $a)
    {
        echo $a;
    }
}

$obj = new MyClass();
 // Works
//echo $obj->protected; // Fatal Error
//echo $obj->private; // Fatal Error
$obj->printHello(11); // Shows Public, Protected and Private