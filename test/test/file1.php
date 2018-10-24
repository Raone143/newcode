<?php
class Test {
    function abc() {
        $a = new self();
        print_r($a);
    }
}
$a = new Test();
$a->abc();