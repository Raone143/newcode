<?php 
$bytes = 13761;
$OneMB = 1048576;

$a = $bytes / $OneMB;
echo $a;

/*
$part = '_part';
$partnum = 1;

$parts = $part.$partnum;
$filename  = 'irecruit_'.date('Ymdhis');
$filename .= $part.$partnum;
echo $filename;exit;
/*
require_once '../irecruitdb.mstr';
require_once '../irecruit.mstr';
require_once 'ClassMonster.inc';
require_once $IRECRUIT_DIR.'common/ClassCommonMethods.inc';

$CommonMethodObj = new CommonMethods;
$OrgsInfo = $CommonMethodObj->getOrgInfo();


$OneMB = 1048576; //1048576 Bytes

$part = 1;
$filename = 'irecruit_'.date('Ymdhis');
for($oi = 0; $oi < count($OrgsInfo); $oi++) {
	
	/*
	$datasizeinbytes = mb_strlen($xml, '8bit');
	
	$datasizeinmb = ceil($datasizeinbytes / $OneMB);
	
	if($datasizeinmb > 48 && $datasizeinmb < 50) {
		
	}
	*/
//}

//$xml .= "</jobs>\n";
//$xml .= "</jobfeed>\n";

?>