<?php 
$filename = "i20140430.xml";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

$contents = str_replace("<![CDATA[", "", $contents);
$contents = str_replace("]]>", "", $contents);
//$contents = str_replace("&amp;", "&", $contents);
?>