<?php 
$soap_request = '<?xml version="1.0" encoding="UTF-8"?>
	<Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
		<Header>
			<MonsterHeader xmlns="http://schemas.monster.com/MonsterHeader"
				xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
				<ChannelId xmlns="http://schemas.monster.com/MonsterHeader">58</ChannelId>
				<MessageData>
					<MessageId>110978756284763763029732_jweba206</MessageId>
					<Timestamp>2015-05-22T01:36:10.410-04:00</Timestamp>
					<RefToMessageId xmlns="http://schemas.monster.com/MonsterHeader">0.38895300 1201759202
					</RefToMessageId>
				</MessageData>
			</MonsterHeader>
		</Header>
		<Body xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
			<Fault>
				<faultcode>Client</faultcode>
				<faultstring><![CDATA[Client not authenticated after processing available headers.]]></faultstring>
			</Fault>
		</Body>
	</Envelope>';


$result = str_replace ( "SOAP-ENV:", "", $soap_request);

$inventoryxml = simplexml_load_string ( $result, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);

echo $inventoryxml->Body->Fault->faultstring;
?>