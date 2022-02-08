<?php   
	/*
	Jack 20220112 v1.0.1
    Jack 20220117 V1.0.2 Add MailStat
	Jack 20220121 V1.0.3 Add Delivery Sub MailDate
	Jack 20220122 V1.0.4 1.Add PostMailNum2 
						 2.Add DATIME
						 3.Add DeliberySub
	Jack 20220207 V1.0.5 Add

	*/
	function get_between($input, $start, $end) {
		//取得中間字串中間字,從$start尾取到$end頭
		$substr = substr($input, strlen($start)+strpos($input, $start),(strlen($input) - strpos($input, $end))*(-1));
		return $substr;
	}
	function DateTime($input){
		//20220118141854 => 2022/01/18-14:18:54
		if ($input <> ''){
			$input = (string)$input;
			$Year  = substr($input, 0,4);//($input,start,length)
			$Year  = $Year - 1911;//民國年
			$Month = substr($input, 4,2);
			$Date  = substr($input, 6,2);
			$HH    = substr($input, 8,2);
			$MM    = substr($input,10,2);
			$SS    = substr($input,12,2);
			$Modified = $Year.".".$Month.".".$Date."-".$HH.":".$MM.":".$SS;
			return $Modified;
		}
	}

	function TaiwanYear($input){
		$Year  = substr($input,0,4);		
		$Year  = $Year-1911; 		
		$Month = substr($input,5,2);		
		$Date  = substr($input,7,2);		
		$TaiwanYear = $Year .".".$Month.".".$Date;
		return $TaiwanYear;
		
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
			case"L":
				return "接單確認";
			case"M":
				return "取件不成功再收";
			case"N":
				return "取件失敗結案";
			case"O":
				return "取件成功";
			case"":	
				return "無資料";//需有空白=無資料,否則出現Null程式會報錯
		}
	}
	function StatInfo($EvCode){
		$code = substr($Evcode,0,2);//兩個都取出來判斷
		switch($code){			
			case "A1" :
				return "窗口收寄";
			case "A2" :
				return "上門收件";
			case "A3" :
				return "i郵箱收寄";
			case "A4" :
				return "到郵務單位交寄";
			case "A6" :
				return "信用卡";	
			case "G1" :
				return "到達支局信箱";
			case "G2" :
				return "到達支局招領中";
			case "G3" :
				return "到達i郵箱";
			case "G4" :
				return "到達投遞局";
			case "G5" :
				return "郵局寄存送達";
			case "G7" :
				return "退回到達投遞局";			
			case "G8" :
				return "退回到達投遞局";			
			case "G9" :
				return "退回到達支局招領中";			
			case "H4" :
				return "投遞局未投妥";
			case "H7" :
				return "投遞局未投妥";
			case "HL" :
				return "文書退回投遞不成功";
			case"I1":
				return "窗口信箱妥投";
			case"I2":
				return "窗口招領妥投";
			case"I3":
				return "i郵箱取件成功";
			case"I4":
				return "投遞局妥投";
			case"I5":
				return "收受人領取";
			case"I6":
				return "警局寄存送達";
			case"IL":
				return "文書退回投遞成功";
			case"I7":
				return "退回投遞成功 ";	
			case"I8":
				return "退回投遞成功";
			case"I9":
				return "退回窗口招領妥投";
			case"P3":
				return "等待入箱中";	
			case"P4":
				return "投遞局直退";	
			case"P5":
				return "安排投遞中";				
			case"Q1":
				return "入帳成功";	
			case"S1":
				return "窗口信箱改寄/改投";			
			case"S2":
				return "窗口招領改寄/改投";
			case"S4":
				return "投遞局改寄/改投";
    		case"T1":
				return "窗口信箱批退";
    		case"T2":
				return "窗口招領批退";
    		case"T3":
				return "i郵箱逾期退招領";
    		case"T4":
				return "投遞局批退";										
    		case"T5":
				return "郵局寄存期滿,退相關單位";										
    		case"T6":
				return "i郵箱郵件撤回";																		
    		case"U2":
				return "誤封";
    		case"V1":
				return "信箱註銷投遞成功記錄";
    		case"V2":
				return "註銷投遞成功記錄";
    		case"V3":
				return "註銷交寄郵件";
    		case"V4":
				return "註銷交寄郵件";
    		case"V5":
				return "招領註銷投遞成功記錄";
    		case"V6":
				return "註銷投遞成功記錄";																				
    		case"VL":
				return "註銷投遞成功記錄";				
    		case"W2":
				return "留局";
    		case"W7":
				return "退回等候收件人來局領";								
    		case"X2":
				return "複查中";
			case"X7":
				return "退回郵件複查中";	
    		case"Y1":
				return "寄存送達郵局轉運中";
    		case"Y4":
				return "郵件投遞中";
    		case"Y5":
				return "寄存送達警局轉運中";
    		case"Y7":
				return "退回郵件投遞中";												
    		case"Z1":
				return "信箱/代辦所郵件轉運中";
    		case"Z2":
				return "招領郵件轉運中";
    		case"Z4":
				return "運輸途中";
    		case"Z5":
				return "公件郵件轉運中";
    		case"Z7":
				return "退回公件轉運中";
    		case"Z8":
				return "退回信箱郵件轉運中";
    		case"Z9":
				return "退回招領郵件轉運中";
			case"":	
				return "無資料";//需有空白=無資料,否則出現Null程式會報錯
			default :
				return "";	
				
		}

	}


		/*
		<MailQueryNewStatusResult>
			<BlueStar MsgName="LIQD" RqUid="f0f89525-ab75-4ffe-aa3b-144a38bc74da" xmlns="http://www.cedar.com.tw/bluestar/" Status="0">
			<TXCODE>
			</TXCODE>
			<TXTYPE>15</TXTYPE>
			<MAILNO>00275410713628                                                                                     </MAILNO>
			<PL>00545</PL>
			<ITEM>
			<MAILNO>00275410713628     </MAILNO>
			<LL>099</LL>
			<EVCODE>I4</EVCODE>
			<STATUS>投遞成功　　　　　　　　　　　</STATUS>
			<BRHNO>100601</BRHNO>
			<BRHNC>內湖郵局郵務股　　　</BRHNC>
			<DATIME>20220118141854</DATIME>
			<OTHER>OKN      </OTHER>
			</ITEM>

			<ITEM>
			<MAILNO>                   </MAILNO>
			<LL>  </LL>
			<EVCODE> </EVCODE>
			<STATUS>                               </STATUS>
			<BRHNO>     </BRHNO>
			<BRHNC>                     </BRHNC>
			<DATIME>             </DATIME>
			<OTHER>         </OTHER>
			</ITEM>

			<ITEM>
			<MAILNO>                   </MAILNO>
			<LL>  </LL>
			<EVCODE> </EVCODE>
			<STATUS>                               </STATUS>
			<BRHNO>     </BRHNO>
			<BRHNC>                     </BRHNC>
			<DATIME>             </DATIME>
			<OTHER>         </OTHER>
			</ITEM>

			<ITEM>
			<MAILNO>                   </MAILNO>
			<LL>  </LL>
			<EVCODE> </EVCODE>
			<STATUS>                               </STATUS>
			<BRHNO>     </BRHNO>
			<BRHNC>                     </BRHNC>
			<DATIME>             </DATIME>
			<OTHER>         </OTHER>
			</ITEM>

			<ITEM>
			<MAILNO>                   </MAILNO>
			<LL>  </LL>
			<EVCODE> </EVCODE>
			<STATUS>                               </STATUS>
			<BRHNO>     </BRHNO>
			<BRHNC>                     </BRHNC>
			<DATIME>             </DATIME>
			<OTHER>         </OTHER>
			</ITEM>

			</BlueStar>
		</MailQueryNewStatusResult>
		*/
	//Declare variable and array to avoid Null
	$i = 0;	
    $unicodeA   = array();//避免出現Array = NULL情況,需宣告
	$BRHNCA     = array();
	$DATIMEA    = array();
	$EvcodeA    = array();
	$num2A      = array();
	$original   = array();
    $targetDate = date("Y/m/d",strtotime('-180 day'));//取得6個月前日期
	var_dump($targetDate);
	$targetDate = TaiwanYear($targetDate);
	var_dump($targetDate);
	$client = new SoapClient("http://sprws.post.gov.tw/PSTTP_MailQuery.asmx?WSDL");//WebServices

	$query = "SELECT PostMailNum ,Unicode ,PostMailNum2 ,statuscode
			  FROM barcode_time 
			  WHERE  PostMailNum <> '' AND statuscode <> 'I'  AND insdate > '$targetDate'
			  ORDER BY insdate DESC";
    
	//DB連線資訊 => ServerIP or NamePipe
	$ServerName = "127.0.0.1";

	//連線參數,必須要設定characterSet=Utf8,否則會出現亂碼
	$connectionInfo = Array(
		"Database"    =>"osundb_test",
		"UID"         =>"osun",
		"PWD"         =>"osun000",
		"CharacterSet"=>"UTF-8"
		);

	//Sqlsrv連線
	$conn = sqlsrv_connect($ServerName,	$connectionInfo);
	if( sqlsrv_begin_transaction($conn) === false ) 
	{ 
		echo "Could not begin transaction.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	
	if ($conn === false){
		$conn = sqlsrv_connect($ServerName,	$connectionInfo);//重連一次
		if ($conn === false){
			echo $ServerName."資料庫連線有問題";
		}
	}

	$stmt1 = sqlsrv_query($conn,$query);

    if ($stmt1) {	
        while ($order = sqlsrv_fetch_object($stmt1)) {
			$num2 	    = $order->PostMailNum2;    //取郵遞區號2
			$num2 	    = is_Null($num2) ? '' : $num2;		
			$num		= $order->PostMailNum;
			$num  		= is_Null($num) ? '' : $num;
			$statuscode = $order->statuscode;
			$statuscode	= is_Null($statuscode) ? '' : $statuscode;
			//如果第二次也拒收 , 則不再偵測
			if ($num2 <> '' && $statuscode <> 'H'){
				$num = $num2;
				if ($num <> '') {
					$unicode = $order->Unicode; //取得Unicode
					$unicode = is_Null($unicode) ? '' : $unicode;
					$params  = array("MAIL_NO" => $num);//將郵遞號碼與MailNo組成陣列
					$unicodeA[$i] = $unicode;  //Unicode寫入陣列
					//MailNo陣列使用MailQueryStatus送出Request 取得stdClass 使用MailQueryNewStatusResult取得XML字串
					$result = $client->MailQueryNewStatus($params)->MailQueryNewStatusResult;    
					
					$BRHNC      = trim(get_between($result, '<BRHNC>', '</BRHNC>'));//取得XML BRHNC欄位=>郵遞單位
					$BRHNCA[$i] = str_replace("　", "",$BRHNC);
					
					$DATIME     = trim(get_between($result, '<DATIME>', '</DATIME>'));//取得XML DATIME欄位
					$DATIMEA[$i]= str_replace("　", "",$DATIME);
					
					$Evcode      = trim(get_between($result, '<EVCODE>', '</EVCODE>'));//取得XML EVCODE欄位
					$EvcodeA[$i] = str_replace("　", "",$Evcode);//替換全形空格                        
					
					$i += 1;
					sleep(1);//1秒只能一次query
				} else {
					continue;
				}
            	sleep(1);
			}
        }
    }else{
	}
  
    //陣列不為空才進入
    if (count($unicodeA) > 0 ) {
        for ($j = 0; $j < (count($unicodeA) - 1); $j++) {

            $unicode   = $unicodeA[$j];//取出unicode			
            $Evcode    = $EvcodeA[$j];//取出郵件狀態碼	
			$BRHNC     = $BRHNCA[$j];//取出郵遞股
			$DATIME    = $DATIMEA[$j];//取出狀態時間	
		//	var_dump($unicode.$Evcode.$BRHNC.$DATIME);
            $stat      = MailStat($Evcode);//配對郵件狀態
			$Remark    = StatInfo($Evcode);		
			$DATIME    = DateTime($DATIME);//日期格式改變
			$RxDate    = substr($DATIME, 0, 8);
			$RxTime    = substr($DATIME,10,17);
            $update    = "UPDATE barcode_time 
						  SET statuscode = '$Evcode' ,mailstatus = '$stat' ,RxTime = '$RxTime',RxDate = '$RxDate',DeliverySub = '$BRHNC',ReMark = '$Remark'
						  WHERE unicode = '$unicode'";

            $stmt1 = sqlsrv_query($conn, $update);
			if( sqlsrv_begin_transaction($conn) === false ) 
			{ 
				echo "Could not begin transaction.\n";
				die( print_r( sqlsrv_errors(), true));
			}
            if ($stmt1) {
                sqlsrv_commit($conn);				
            } else {
                sqlsrv_rollback($conn);				
            }
        }
    }
	
    sqlsrv_close( $conn );
?>  

