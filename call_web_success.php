
<?php
$client = new SoapClient("http://sprws.post.gov.tw/PSTTP_MailQuery.asmx??WSDL");
//此webservice需傳入兩個參數，第一個為員工工號，第二個為服務密碼
$params = array("MAIL_NO" => "00307610913618");
$result = $client->MailQuerySingle($params)->MailQuerySingleResult;
echo $result;
?>