<?
//要發送的變量
$myString="01489424103631303002";

//parameters must be passed as an array
//變量必須要轉換成數組的形式
$parameters=array($myString);

//創建一個soapclient對象，參數是server的URL
$s=new soapclient('http://sprws.post.gov.tw/PSTTP_MailQuery.asmx?WSDL');

//調用遠程方法，返回值存放在$result
//返回值為PHP的變量類型，如string, integer, array
$result=$s->MailQueryNewStatus('echoString', $parameters);



//調試，以下是SOAP請求(request)和回應(response)的報文，包括HTTP頭
echo "＜xmp＞".$s->request."＜/xmp＞";
echo "＜xmp＞".$s->response."＜/xmp＞";

?>