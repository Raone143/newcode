<?php 
$soap_request = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
  <SOAP-ENV:Header>
    <mh:MonsterHeader xmlns:mh="http://schemas.monster.com/MonsterHeader">
      <mh:MessageData>
        <mh:MessageId>0.38895300 1201759202</mh:MessageId>
        <mh:Timestamp>2008-01-31T07:00:02Z</mh:Timestamp>
      </mh:MessageData>
    </mh:MonsterHeader>
    <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/04/secext">
      <wsse:UsernameToken>
        <wsse:Username>xrtpjobsx01</wsse:Username>
        <wsse:Password>rtp987654</wsse:Password>
      </wsse:UsernameToken>
    </wsse:Security>
  </SOAP-ENV:Header>
  <SOAP-ENV:Body>
    <InventoriesQuery xmlns="http://schemas.monster.com/Monster" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
      <LicenseFilter monsterId="3">All</LicenseFilter>
      <LicenseType monsterId="1">Job Inventory</LicenseType>
    </InventoriesQuery>
  </SOAP-ENV:Body>
</SOAP-ENV:Envelope>';

$header = array (
		"Content-type: text/xml;charset=\"utf-8\"",
		"Accept: text/xml",
		"Cache-Control: no-cache",
		"Pragma: no-cache",
		"SOAPAction: \"run\"",
		"Content-length: " . strlen ( $soap_request )
);

$soap_do = curl_init ();
curl_setopt ( $soap_do, CURLOPT_URL, "https://gateway.monster.com:8443/bgwBroker" );
curl_setopt ( $soap_do, CURLOPT_CONNECTTIMEOUT, 10 );
curl_setopt ( $soap_do, CURLOPT_TIMEOUT, 10 );
curl_setopt ( $soap_do, CURLOPT_RETURNTRANSFER, true );
curl_setopt ( $soap_do, CURLOPT_SSL_VERIFYPEER, false );
curl_setopt ( $soap_do, CURLOPT_SSL_VERIFYHOST, false );
curl_setopt ( $soap_do, CURLOPT_POST, true );
curl_setopt ( $soap_do, CURLOPT_POSTFIELDS, $soap_request );
curl_setopt ( $soap_do, CURLOPT_HTTPHEADER, $header );

$result = curl_exec ( $soap_do );
// ###########################################################################################
$result = str_replace ( "SOAP-ENV:", "", $result );

echo "<xmp>";echo $result;
?>