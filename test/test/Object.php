<?php
$requestParams = array(
    'CityName' => 'Hyderabad',
    'CountryName' => 'India'
);

$client = new SoapClient('http://www.webservicex.net/globalweather.asmx?WSDL');
$response = $client->GetWeather($requestParams);

print_r($response);
?> 