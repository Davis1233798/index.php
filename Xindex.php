<?php
try
{		
	$soap_client = new
		//SoapClient("http://sprwsg.post.gov.tw/PSTLM_WebService.asmx?WSDL");
		SoapClient("http://sprwsg.post.gov.tw/PSTTP_MailQuery.asmx?WSDL");
	$vec = array("MAIL_NO","00309110913618");
	// $MainlandExpressMail = $soap_client->QueryMainlandExpressMail($vec);
	// var_dump($MainlandExpressMail);
	// $QueryMainlandLetter = $soap_client->QueryMainlandLetter($vec);
	// var_dump($QueryMainlandLetter);
	$A= $soap_client->	QueryIntlPackage($vec);
	var_dump($A);		
	$A= $soap_client->	QueryMainlandPackage($vec);
	var_dump($A);		
	$A= $soap_client->	QueryIntlExpressMail($vec);
	var_dump($A);		
	$A= $soap_client->	QueryMainlandExpressMail($vec);
	var_dump($A);		
	$A= $soap_client->	QueryIntlLetter	($vec);
	var_dump($A);		
	$A= $soap_client->	QueryMainlandLetter($vec);
	var_dump($A);		
	$A= $soap_client->	QueryIntlePacket($vec);
	var_dump($A);		
	$A= $soap_client->	QueryMainlandePacket($vec);
	var_dump($A);	
	
	

}
catch(SoapFault $exception)
{
	echo $exception->getMessage();
}
?>