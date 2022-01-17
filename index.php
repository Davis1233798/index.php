<?php   
	//Jack 20220112 v1.0.1
    //Jack 20220117 V1.0.2 Add MailStat
	function get_between($input, $start, $end) {
		//取得中間字串中間字,從$start尾取到$end頭
		$substr = substr($input, strlen($start)+strpos($input, $start),(strlen($input) - strpos($input, $end))*(-1));
		return $substr;
	}

	function MailStat($Evcode){
		$code = substr($Evcode,0,1);//取第一個字
		switch($code){			
			case "A" :
				return "交寄郵件";
			case "G" :
				return "到達投遞局";
			case"H":
				return "投遞不成功";
			case"I":
				return "投遞成功";
			case"P":
				return "郵局內部移交";	
			case"Q":
				return "入帳";	
			case"S":
				return "變更收件地址";			
    		case"T":
				return "無法投遞退相關單";
    		case"U":
				return "誤封";
    		case"V":
				return "註銷投遞成功記錄";
    		case"W":
				return "等候收件人來局領";
    		case"X":
				return "複查中";
    		case"Y":
				return "郵件投遞中";
    		case"Z":
				return "運輸途中";//文件上無標示,但狀態皆為運輸途中,故此處標示為運輸途中			
			case"":	
				return "無資料";//需有空白=無資料,否則出現Null程式會掛掉
		}
	}

	$i = 0;	
    $unicodeA = array();//避免出現Array = NULL情況,需宣告
    $targetDate = date("Y/m/d",strtotime('-180 day'));//取得6個月前日期
//	var_dump($targetDate);
	//$query = "select PostMailNum ,Unicode from barcode_time where  PostMailNum <> '' and (statuscode <> 'I' or statuscode <> 'H')  order by insdate desc";
	$query = "select PostMailNum ,Unicode from barcode_time where  PostMailNum <> '' order by insdate desc";
//	var_dump($query);
    $client = new SoapClient("http://sprws.post.gov.tw/PSTTP_MailQuery.asmx?WSDL");
	$ServerName = "127.0.0.1";//ServerIP or NamePipe
	$connectionInfo = Array("Database"=>"osundb_test","UID"=>"osun","PWD"=>"osun000","CharacterSet"=>"UTF-8");//連線參數,必須要設定characterSet=Utf8,否則會出現亂碼
	
	$conn = sqlsrv_connect($ServerName,	$connectionInfo);
	if ($conn === false){
		$conn = sqlsrv_connect($ServerName,	$connectionInfo);//重連一次
		if ($conn === false){
			echo $ServerName."資料庫連線有問題";
		}
	}

	$stmt1 = sqlsrv_query($conn,$query);
    if ($stmt1) {	
        while ($order = sqlsrv_fetch_object($stmt1)) {
            $num = $order->PostMailNum;    //取得郵遞編號
		
            $num = is_Null($num) ? '' : $num;
            if ($num <> '') {
                $unicode = $order->Unicode; //取得Unicode
                $unicode = is_Null($unicode) ? '' : $unicode;
                $params = array("MAIL_NO" => $num);//將郵遞號碼與MailNo組成陣列
                $unicodeA[$i] = $unicode;  //Unicode寫入陣列
                $result = $client->MailQueryNewStatus($params)->MailQueryNewStatusResult;    //MailNo陣列使用MailQueryStatus送出Request 取得stdClass 使用MailQueryNewStatusResult取得XML字串
                $Evcode = trim(get_between($result, '<EVCODE>', '</EVCODE>'));//取得XML EVCODE欄位
                $Evcode = str_replace("　", "",$Evcode);//替換全形空格        
                
                $statA[$i] = trim($Evcode);
                $i += 1;
                sleep(1);//1秒只能一次query
            } else {
                continue;
            }
            sleep(1);
        }
    }else{
	}
  
    //陣列不為空才進入
    if (count($unicodeA) > 0 ) {
        for ($j = 0; $j < (count($unicodeA) - 1); $j++) {
            $unicode = $unicodeA[$j];			
            $statcode = $statA[$j];//取出郵件狀態碼					
            $stat = MailStat($statcode);//配對郵件狀態
		
            $update = "update barcode_time set statuscode = '$statcode' ,mailstatus='$stat'  WHERE unicode = '$unicode'";
            $stmt1 = sqlsrv_query($conn, $update);
            if ($stmt1) {
                sqlsrv_commit($conn);
				
            } else {
                sqlsrv_rollback($conn);
				
            }
        }
    }
	

?>  

