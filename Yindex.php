<?
$xmldata = <<<EOT
POST /PSTTP_MailQuery.asmx HTTP/1.1
Host: sprws.post.gov.tw
Content-Type: text/xml; charset=utf-8
Content-Length: length
SOAPAction: "http://tempuri.org/MailQuerySingle"

<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <MailQuerySingle xmlns="http://tempuri.org/">
      <MAIL_NO>01489424103631303002</MAIL_NO>
    </MailQuerySingle>
  </soap:Body>
</soap:Envelope>
EOT;
$wsdl = 'http://sprws.post.gov.tw/PSTTP_MailQuery.asmx?WSDL';
try{
    $client = new SoapClient($wsdl);
    $result = $client->__doRequest($xmldata,$wsdl,'http://sprws.post.gov.tw/PSTTP_MailQuery.asmx',1,0);//傳送xml請求 __doRequest
    var_dump($result);
}catch (SoapFault $e){
    echo $e->getMessage();
}catch(Exception $e){
    echo $e->getMessage();
}
?>