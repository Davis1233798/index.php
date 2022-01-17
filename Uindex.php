<?php
try {
    $soap_client = new
		//SoapClient("http://sprwsg.post.gov.tw/PSTLM_WebService.asmx?WSDL");
		//SoapClient("http://sprwsg.post.gov.tw/PSTTP_MailQuery.asmx?WSDL");
        SoapClient("http://sprws.post.gov.tw/PSTTP_MailQuery.asmx?WSDL");
	
    $pdo = new PDO('sqlsrv:Server=127.0.0.1;Database=osundb_test',"osun","osun000");
    //"Database"=>"osundb_test","UID"=>"osun","PWD"=>"osun000");
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    echo json_encode('Error connecting to the server.');
    die ();
    }
        $sql = "SELECT PostMailNum FROM barcode_time where arrivaldate >'100.12.20'";
        $query = $pdo->query($sql);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($query as $row){
            //echo $row['PostMailNum'].'<br>';
            //$vec = array("MAIL_NO",$row['PostMailNum']);
            $vec = array("MAIL_NO","01489424103631303002");
            $A= $soap_client->	MailQueryNewStatus($vec);
	        var_dump($A);		        
        }
        ?>




