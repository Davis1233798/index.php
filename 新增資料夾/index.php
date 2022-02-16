<?   
	//Jack 20220112 v1.0.1
	function get_between($input, $start, $end) {
		$substr = substr($input, strlen($start)+strpos($input, $start),(strlen($input) - strpos($input, $end))*(-1));
		return $substr;
	}

	// function MailStat($Evcode){
	// 	$code = substr($Evcode,0,1);//取第一個字
	// 	switch($code){			
	// 		case "A" :
	// 			return"交寄郵件";
	// 		case "G" :
	// 			return"到達投遞局";
	// 		case"H":
	// 			return "投遞不成功";
	// 		case"I":
	// 			return;
	// 		case"P":
	// 			return;	
	// 		case"Q":
	// 			return;	
	// 		case"S":
	// 			return;			
			
	// 	}
	// }


	$i = 0;
	$client = new SoapClient("http://sprws.post.gov.tw/PSTTP_MailQuery.asmx?WSDL");
	$ServerName = "127.0.0.1";
	$connectionInfo = Array("Database"=>"osundb_test","UID"=>"osun","PWD"=>"osun000","CharacterSet"=>"UTF-8");
	$conn = sqlsrv_connect($ServerName,	$connectionInfo);
	if ($conn === false){
		$conn = sqlsrv_connect($ServerName,	$connectionInfo);//重連一次
			if ($conn === false){
				echo "連線有問題";
			}
	}
	//$today = date("Y/m/d");
    $unicodeA = array();
    $targetDate = date("Y/m/d",strtotime('-90 day'));//取得3個月前日期
	$query = "select PostMailNum ,Unicode from barcode_time where arrivaldate > '$targetDate' and  PostMailNum <> ''  and statuscode <> '@' order by insdate desc";
	$stmt1 = sqlsrv_query($conn,$query);
    if ($stmt1) {
        while ($order = sqlsrv_fetch_object($stmt1)) {

            $num = $order->PostMailNum;    //取得郵遞編號
            $num = is_Null($num) ? '' : $num;
            if ($num <> '') {
                $unicode = $order->Unicode;      //取得Unicode
                $unicode = is_Null($unicode) ? '' : $unicode;
                $params = array("MAIL_NO" => $num);//將郵遞號碼與MailNo組成陣列
                $unicodeA[$i] = $unicode;            //Unicode寫入陣列
                $result = $client->MailQueryNewStatus($params)->MailQueryNewStatusResult;    //MailNo陣列使用MailQueryStatus送出Request 取得stdClass 使用MailQueryNewStatusResult取得XML字串
                $stat = trim(get_between($result, '<STATUS>', '</STATUS>'));//取得XML STATUS欄位
                $stat = str_replace("　", "", $stat);//替換全形空格
                $statA[$i] = trim($stat);
                $i += 1;
                sleep(1);//1秒只能一次query
            } else {
                continue;
            }
            sleep(1);
        }
    }else{
        return "ontinue";
    }
  // echo count(count($unicodeA));
   // var_dump($unicodeA);
    if (is_Null($unicodeA) === false){
        if (count($unicodeA) > 0 ) {
            for ($j = 0; $j < (count($unicodeA) - 1); $j++) {
                $unicode = $unicodeA[$j];
                $stat = $statA[$j];
                $update = "update barcode_time set stat = '$stat' WHERE unicode = '$unicode'";
                $stmt1 = sqlsrv_query($conn, $update);
                if ($stmt1) {
                    sqlsrv_commit($conn);
                } else {
                    sqlsrv_rollback($conn);
                }
            }
        }
	}

?>  

