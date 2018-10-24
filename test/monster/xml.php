<?php 
$c = simplexml_load_file('irecruit.xml', 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
echo "<pre>";print_r($c);
?>
