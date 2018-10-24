<?php
include 'jobs.php';
$xml  = '<?xml version="1.0" encoding="utf-8"?>';
$xml .= '<jobfeed>';
$xml .= '<provider>irecruit</provider>';
$xml .= '<isfullfeed>true</isfullfeed>';
$xml .= '<part>1</part>';
$xml .= '<islast>true</islast>';
$xml .= '<jobs>';

for($l = 44; $l < 1105; $l++) {
	$jobtitle = str_replace(" Jobs", "", $links[$l]['text']);
	$uniqid = uniqid().rand();
	$xml .= '<job>';
	$xml .= '<title><![CDATA['.$jobtitle.']]></title>
   		 <refcode><![CDATA['.$uniqid.']]></refcode>
   		 <url><![CDATA[https://dev.irecruit-us.com/public/jobRequest.php?OrgID=I20120605&amp;RequestID='.$uniqid.'&amp;source=MONSTER]]></url>
   		 <company><![CDATA[ABC Technologies.]]></company>
   		 <city><![CDATA[Astoria]]></city>
 	 	 <state><![CDATA[NY]]></state>
   		 <postalcode><![CDATA[11102]]></postalcode>
		 <country><![CDATA[US]]></country>
   		 <description><![CDATA[<p><span style="color: #215968;"><span style="font-size: small;"><span style="font-family: Calibri;"><span style="font-size: medium;">This is testing job. Please ignore it. Please dont apply. If you do not see any positions available that match your experience and qualifications, but would still like to submit your resume for future consideration, please apply here</span>.</span></span></span></p>]]></description>
		 <posteddate>2015-02-06T05:00:57</posteddate>
		 <awm>
		 	<method>POST</method>
			<format>JSON</format>
			<apikey>EAAQREqkci5Ia3gYVNUIGO5lGG.nyL0jKDtzUSuz.0aalIg-</apikey>
			<posturl>https://dev.irecruit-us.com/irecruit/monster/saveMonsterApplicantInfo.php</posturl>
		 </awm>';
	$xml .= '</job>';
}




$xml .= '</jobs>';
$xml .= '</jobfeed>';

/*
header('Content-type: application/xml');
echo $xml;
*/

$fh = fopen ("irecruit.xml", 'w' );
fwrite ( $fh, $xml);
fclose ( $fh );
?>