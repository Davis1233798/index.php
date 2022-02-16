<?php 
$soapUrl = "http://www.webxml.com.cn/WebServices/WeatherWebService.asmx";
$xmldata = <<<EOT
<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <getSupportProvince xmlns="http://WebXml.com.cn/" />
  </soap:Body>
</soap:Envelope>
EOT;

$headers = array(
"POST /WebServices/WeatherWebService.asmx HTTP/1.1",
"Host: www.webxml.com.cn",
"Content-Type: text/xml; charset=utf-8",
"Content-Length: ".strlen($xmldata)
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $soapUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmldata);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch); 
curl_close($ch);

$response1 = str_replace("<soap:Body>","",$response);
$response2 = str_replace("</soap:Body>","",$response1);

$parser = simplexml_load_string($response2);


$xmljson= json_encode($parser);
$xmlarray=json_decode($xmljson,true);
print_r($xmlarray);
?>