<?php
$xml = simplexml_load_file("CCD_Amubulatory.xml");
//echo "<pre>";echo count($xml->component->structuredBody->component);
$component_count = count($xml->component->structuredBody->component);

for($c = 0; $c < $component_count; $c++) {
	$codes = $xml->component->structuredBody->component[$c]->section->code[0];
	//Get attributes of code root node in component/section
	//foreach($codes->attributes() as $attribute_name => $attribute_value) {
	    if($attribute_value == "11369-6") {
	    	echo $c+1;	
	    }
	    //echo "<br>";
	    //if($attribute_name == "code") echo $attribute_value."<br>";
	//}
}

/*

function xml_attribute($object, $attribute)
{
	if(isset($object[$attribute]))
		return (string) $object[$attribute];
}

$xml = simplexml_load_file("CCD_Ambulatory.xml");


$xml->registerXPathNamespace('prefix', 'urn:hl7-org:v3');
$informant = $xml->xpath("//prefix:informant");
foreach ($informant as $entry) {
 //echo "<pre>";print_r($entry);
}

echo "<br><br>Component starts here..<br>";

//echo 'to check if allergy is present';

$component = $xml->xpath("//prefix:component/prefix:structuredBody/prefix:component[1]/prefix:section/prefix:entry[1]/prefix:act/prefix:entryRelationship/prefix:observation/prefix:value/@code");

$a = xml_attribute($component[0], 'code');
print_r($a);
/*
function array2XML($arr,$root) {
	$xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><{$root}></{$root}>");
	$f = create_function('$f,$c,$a','
        foreach($a as $v) {
            if(isset($v["@text"])) {
                $ch = $c->addChild($v["@tag"],$v["@text"]);
            } else {
                $ch = $c->addChild($v["@tag"]);
                if(isset($v["@items"])) {
                    $f($f,$ch,$v["@items"]);
                }
            }
            if(isset($v["@attr"])) {
                foreach($v["@attr"] as $attr => $val) {
                    $ch->addAttribute($attr,$val);
                }
            }
        }');
	$f($f,$xml,$arr);
	return $xml->asXML();
}

$homepage = file_get_contents("CCDA_Ambulatory.xml");
$xml = new SimpleXMLElement('/ClinicalDocument/component/structuredBody/title');
print_r($xml);
exit;
$result = $xml->xpath('/a/b/c');

$xml = simplexml_load_string($homepage, 'SimpleXMLElement', LIBXML_NOCDATA);//LIBXML_NOCDATA LIBXML_NOWARNING 
$nodes = $xml->xpath('//ClinicalDocument/component/structuredBody/title');
$toyota_cars = $xml->xpath('//ClinicalDocument/component/structuredBody/title');
print_r($toyota_cars);
foreach ($nodes as $node) {
	print_r($node);
}
exit;

$reader = new XMLReader();
$reader->open("CCD_Amubulatory.xml");
while ($reader->read()) {
    switch ($reader->nodeType) {
        case (XMLREADER::ELEMENT):
        if ($reader->localName == "structuredBody") {
                $node = $reader->expand();
                $dom = new DomDocument();
                $n = $dom->importNode($node,true);
                $dom->appendChild($n);
                $xp = new DomXpath($dom);
                $res = $xp->query("/ClinicalDocument/component/structuredBody/title");
                print_R($res);
        }
    }
}*/
?>
