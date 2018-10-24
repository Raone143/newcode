<?php
	//$client = new SoapClient('http://www.webservicex.com/CurrencyConvertor.asmx?wsdl', array('trace' => true, 'soap_version' => SOAP_1_2));
//echo "<pre>";print_r($client->__getFunctions());
//$vem = $client->__call('GetCitiesByCountry',array("usa"));
	
	//$res = $client->ConversionRate( $data );
		
	//$data['FromCurrency'] = 'USD'
	//$data['ToCurrency']['raju']['age'] = 26;
	
	//echo "<pre>";print_r($_SERVER);
	// Define URL where the form resides
	
	//$form_url = "http://localhost/codeigniter/user/registration";
	$form_url = "http://localhost/codeigniter/user/registration";
	
	// This is the data to POST to the form. The KEY of the array is the name of the field. The value is the value posted.
	$data_to_post = array();
	$data_to_post['email'] = 'hellow how are you';
	$data_to_post['password'] = 'testing';
	$data_to_post['registration'] = 'Submit';
	
	// Initialize cURL
	$curl = curl_init();
	print_r($curl);
	// Set the options
	curl_setopt($curl,CURLOPT_URL, $form_url);
	
	// This sets the number of fields to post
	curl_setopt($curl,CURLOPT_POST, sizeof($data_to_post));
	
	// This is the fields to post in the form of an array.
	curl_setopt($curl,CURLOPT_POSTFIELDS, $data_to_post);
	
	//execute the post
	$result = curl_exec($curl);
	
	//close the connection
	curl_close($curl);
	
	print_r($data_to_post);
	/*
	$url = "http://graphical.weather.gov/xml/sample_products/browser_interface/ndfdXMLclient.php?lat=38.99&lon=-77.01&product=time-series&";
	$url .= "begin=".date('Y-m-dTH:i:s')."&end=".date('Y-m-dTH:i:s');
	$url .= "&maxt=maxt&mint=mint";
	//$contents = file_get_contents($url);
	
	// Create a curl handle
	$ch = curl_init($url);
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// Execute
	$data = curl_exec($ch);
	
	// Check if any error occured
	if(!curl_errno($ch))
	{
		$info = curl_getinfo($ch);
	
		echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
	}
	
	// Close handle
	curl_close($ch);
	
	echo "<xmp>";
	echo $data; */
?>