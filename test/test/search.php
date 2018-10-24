<?php
include 'Array2XML.php';
include 'XML2Array.php';
$filename = "file1.xml";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

$array = XML2Array::createArray($contents);
//echo "<pre>";print_r($array);

$xml = "";
$common_array = $array['soap:Envelope']['soap:Body']['SearchResponse']['SearchResult']['Result'];
for($i = 0; $i < count($common_array['WSResult']); $i++) {
    $xmlObj = Array2XML::createXML('WSResult', $common_array['WSResult'][$i]);
    $xml .= str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $xmlObj->saveXML());
}
echo $xml;

