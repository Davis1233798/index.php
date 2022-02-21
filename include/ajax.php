<?
include_once(__DIR__."/baseclass.php");

try{

$fn = get_post("fn");

switch($fn){
	default:
		throw new exception("功能不存在");
		break;
	case "recommand_1":
		$gender = get_post("gender", 0);
		$pregnancy = get_post("pregnancy", 0);
		$age = get_post("age", 0);
		$sick = get_post("sick", 0);
		$smoke = get_post("smoke", 0);
		
		if($pregnancy!='0'){
			$result = array(
				'ok'=>'P',
				'msg'=>'您好'.PHP_EOL.'因孕期中不適合進行健康檢查，請您確認您非懷孕婦女，或孕期結束後再行預約健康檢查。'.PHP_EOL.'臺北榮總健康管理中心期待您再次光臨'
			);
		} else {
			$_SESSION[$_env['site_code'].'_recommand'] = array(
				'gender'=>$gender,
				'pregnancy'=>$pregnancy,
				'age'=>$age,
				'sick'=>$sick,
				'smoke'=>$smoke,
			);
			$result = array(
				'ok'=>'t',
			);
		}
		break;
	case "recommand_2":
		$heart_sick = json_decode(get_post("heart_sick", ''));
		$drug = json_decode(get_post("drug", ''));
		$allergy = get_post("allergy", '');
		$hospitalization = get_post("hospitalization", '');
		
		$_SESSION[$_env['site_code'].'_recommand']['heart_sick'] = $heart_sick;
		$_SESSION[$_env['site_code'].'_recommand']['drug'] = $drug;
		$_SESSION[$_env['site_code'].'_recommand']['allergy'] = $allergy;
		$_SESSION[$_env['site_code'].'_recommand']['hospitalization'] = $hospitalization;
		
		$result = array(
			'ok'=>'t',
		);
		break;
	case "recommand_3":
		$health_package_1 = json_decode(get_post("health_package_1", ''));
		$health_package_2 = json_decode(get_post("health_package_2", ''));
		$self_pay_item = json_decode(get_post("self_pay_item", ''));
		
		$_SESSION[$_env['site_code'].'_recommand']['health_package_1'] = $health_package_1;
		$_SESSION[$_env['site_code'].'_recommand']['health_package_2'] = $health_package_2;
		$_SESSION[$_env['site_code'].'_recommand']['self_pay_item'] = $self_pay_item;
		
		$result = array(
			'ok'=>'t',
		);
		break;
	case "recommand_4":
		$id_type = get_post('id_type', '');
		$id_type_name = get_post('id_type_name', '');
		if(mb_substr(trim(get_post('name', '')),0,1,"utf-8")=='　'){throw new exception('姓名首字包含不合法字元，請檢查');};
		$name = str_replace('　', '', trim(get_post('name', '')));
		$gender = get_post('gender', 0);
		$identity = get_post('identity', '');
		$birthday = get_post('birthday', '');
		$resv_date_s = get_post('resv_date_s', '');
		$resv_date_e = get_post('resv_date_e', '');			
		$add_drug = get_post('add_drug', '');
		$add_report = get_post('add_report', '');
		$tel_home = get_post('tel_home', '');
		$tel_office = get_post('tel_office', '');
		$mobile = get_post('mobile', '');
		$fax = get_post('fax', '');
        $mail = get_post('mail', '');
        $meal = get_post('meal', '');
        $quota = get_post('quota', '');

		if($name=='') throw new exception('請輸入姓名');
		if($identity=='') throw new exception('請輸入身分證/護照');
		if($birthday=='') throw new exception('請輸入生日');
		if($resv_date_s=='') throw new exception('請輸入希望預約日期(起)');
		if($resv_date_e=='') throw new exception('請輸入希望預約日期(迄)');
		if($add_drug=='') throw new exception('請輸入寄藥地址');
		if($add_report=='') throw new exception('請輸入寄報告地址');
		if($tel_home=='') throw new exception('請輸入聯絡電話(H)');
		if($tel_office=='') throw new exception('請輸入聯絡電話(O)');
		if($mobile=='') throw new exception('請輸入行動電話');
		if($mail=='') throw new exception('請輸入電子郵件');
		if(chk_is_mail($mail)===false) throw new exception('電子郵件格式錯誤');
        if($meal=='00' && $quota !='') throw new exception('代餐尚未選擇,請勿填寫數量');
		
		$_SESSION[$_env['site_code'].'_recommand']['id_type'] = $id_type;
		$_SESSION[$_env['site_code'].'_recommand']['id_type_name'] = $id_type_name;
		$_SESSION[$_env['site_code'].'_recommand']['name'] = $name;
		$_SESSION[$_env['site_code'].'_recommand']['gender'] = $gender;
		$_SESSION[$_env['site_code'].'_recommand']['identity'] = $identity;
		$_SESSION[$_env['site_code'].'_recommand']['birthday'] = Date('Y/m/d', strtotime($birthday));
		$_SESSION[$_env['site_code'].'_recommand']['resv_date_s'] = Date('Y/m/d', strtotime($resv_date_s));
		$_SESSION[$_env['site_code'].'_recommand']['resv_date_e'] = $resv_date_e==''?'':Date('Y/m/d', strtotime($resv_date_e));
		$_SESSION[$_env['site_code'].'_recommand']['add_drug'] = $add_drug;
		$_SESSION[$_env['site_code'].'_recommand']['add_report'] = $add_report;
		$_SESSION[$_env['site_code'].'_recommand']['tel_home'] = $tel_home;
		$_SESSION[$_env['site_code'].'_recommand']['tel_office'] = $tel_office;
		$_SESSION[$_env['site_code'].'_recommand']['mobile'] = $mobile;
		$_SESSION[$_env['site_code'].'_recommand']['fax'] = $fax;
		$_SESSION[$_env['site_code'].'_recommand']['mail'] = $mail;
        $_SESSION[$_env['site_code'].'_recommand']['meal'] = $meal;
        $_SESSION[$_env['site_code'].'_recommand']['quota'] = $quota;

		$result = array(
			'ok'=>'t',
		);
//        if([$_env['site_code'].'_recommand']['$mail']) throw new exception(echo $mail);
		break;
	case "recommand_5":
		if(![$_env['site_code'].'_recommand']) throw new exception('SESSION');
		$memo = get_post('memo', '');
        $meal =  get_post('meal', 'NA');
        $quota = get_post('quota', 'NA');


//        if([$_env['site_code'].'_recommand']['$meal']) throw new exception(echo $meal);
		$_SESSION[$_env['site_code'].'_recommand']['memo'] = $memo;
        $_SESSION[$_env['site_code'].'_recommand']['meal'] = $meal;
        $_SESSION[$_env['site_code'].'_recommand']['quota'] = $quota;

		$data = $_SESSION[$_env['site_code'].'_recommand'];

		// 寫入預約紀錄
		$para = array(
			'id_type' => $data['id_type'],
			'id_type_name' => $data['id_type_name'],
			'name' => $data['name'],
			'gender' => $data['gender'],
			'identity' => $data['identity'],
			'birthday' => $data['birthday'],
			'resv_date_s' => $data['resv_date_s'],
			'resv_date_e' => $data['resv_date_e'],
			'add_drug' => $data['add_drug'],
			'add_report' => $data['add_report'],
			'tel_home' => $data['tel_home'],
			'tel_office' => $data['tel_office'],
			'mobile' => $data['mobile'],
			'fax' => $data['fax'],
			'mail' => $data['mail'],
			'price' => $data['price'],
			'memo' => $data['memo'],
			'created' => Date('Y-m-d H:i:s'),
            'meal' => $data['meal'],
            'quota' => $data['quota'],
		);
		$last_id = $db->doinsert('reservation', $para);

		/*========寫入預約項目========*/
		// 寫入預約健檢套組
		$arr_package_1 = array();
		foreach($data['health_package_1'] AS $k=>$v){
			$para = array(
				'resv_id'=>$last_id,
				'type'=>'1',
				'item_id'=>$v,
			);
			array_push($arr_package_1, $v);
			$db->doinsert('reservation_item', $para);
		}
		
		// 寫入預約高階檢查
		$arr_package_2 = array();
		foreach($data['health_package_2'] AS $k=>$v){
			$para = array(
				'resv_id'=>$last_id,
				'type'=>'2',
				'item_id'=>$v,
			);
			array_push($arr_package_2, $v);
			$db->doinsert('reservation_item', $para);
		}
		
		// 寫入預約自費項目
		$arr_self_pay_item = array();
		foreach($data['self_pay_item'] AS $k=>$v){
			$para = array(
				'resv_id'=>$last_id,
				'type'=>'3',
				'item_id'=>$v,
			);
			array_push($arr_self_pay_item, $v);
			$db->doinsert('reservation_item', $para);
		}
		/*========寫入預約項目========*/

		/*========寫入推薦問卷========*/
		// 懷孕婦女
		if(array_key_exists('pregnancy', $data)){
			$para = array(
				'resv_id'=>$last_id,
				'step'=>'1',
				'quest'=>'2',
				'ans'=>$data['pregnancy']=='1'?'是':'否',
			);
		}
		$db->doinsert('reservation_quest', $para);
		
		// 有無個人/家族心臟病史
		if(array_key_exists('sick', $data)){
			$para = array(
				'resv_id'=>$last_id,
				'step'=>'1',
				'quest'=>'4',
				'ans'=>$data['sick']=='1'?'是':'否',
			);
			$db->doinsert('reservation_quest', $para);
		}
		
		// 有無吸菸
		if(array_key_exists('smoke', $data)){
			$para = array(
				'resv_id'=>$last_id,
				'step'=>'1',
				'quest'=>'5',
				'ans'=>$data['smoke']=='1'?'是':'否',
			);
			$db->doinsert('reservation_quest', $para);
		}
		
		// 過去病史
		$arr_heart_sick = array();
		if(array_key_exists('heart_sick', $data)){
			foreach($data['heart_sick'] as $row) array_push($arr_heart_sick, $_env['heart_sick'][$row]);
			$para = array(
				'resv_id'=>$last_id,
				'step'=>'2',
				'quest'=>'1',
				'ans'=>implode(', ', $arr_heart_sick),
			);
			$db->doinsert('reservation_quest', $para);
		}
		
		// 抗凝血劑
		$arr_drug = array();
		if(array_key_exists('drug', $data)){
			foreach($data['drug'] as $row) array_push($arr_drug, $_env['drug'][$row]);
			$para = array(
				'resv_id'=>$last_id,
				'step'=>'2',
				'quest'=>'2',
				'ans'=>implode(', ', $arr_drug),
			);
			$db->doinsert('reservation_quest', $para);
		}
		
		// 過敏藥物
		if(array_key_exists('allergy', $data)){
			$para = array(
				'resv_id'=>$last_id,
				'step'=>'2',
				'quest'=>'3',
				'ans'=>$data['allergy'],
			);
			$db->doinsert('reservation_quest', $para);
		}
		
		// 近三個月住院
		if(array_key_exists('hospitalization', $data)){
			$para = array(
				'resv_id'=>$last_id,
				'step'=>'2',
				'quest'=>'4',
				'ans'=>$data['hospitalization'],
			);
			$db->doinsert('reservation_quest', $para);
		}
		/*========寫入推薦問卷========*/

		/*========寫入mssql========*/
		$mssql_para = array(
			'examno'=>(date('Y')-1911).'1'.str_repeat('0', 5-strlen($last_id)).$last_id,
			'racecode'=>$_env['id_type'][$data['id_type']],
			'hregname'=>$data['id_type_name'],
			'regname'=>$data['name'],
			'sex'=>$data['gender']=='1'?'男':'女',
			'mob'=>$data['mobile'],
			'tel1'=>$data['tel_home'],
			'package'=>'',
			'id'=>$data['identity'],
			'dob'=>$data['birthday'],
			'nowadd'=>$data['add_drug'],
			'preferdate1'=>$data['resv_date_s'],
			'preferdate2'=>$data['resv_date_e'],
			'reportreceiver'=>$data['name'],
			'reportaddr'=>$data['add_report'],
			'tel2'=>$data['tel_office'],
			'fax'=>$data['fax'],
            'meal' => $data['meal'],
            'quota' => $data['quota'],
			'status'=>'1',
			'email'=>$data['mail'],
			'Cost'=>$data['price'],
			'Remark'=>'',
			'InsDate' => Date('Y/m/d'),
		);

		// 基本組套
		$mssql_para['package'] .= '基本組套：';
		if(count($arr_package_1)>0){
			$sql_package_1 = 'SELECT name FROM health_package WHERE id IN (?'.(str_repeat(', ?', count($arr_package_1)-1)).')';
			$sth = $db->obj_pdo->prepare($sql_package_1);
			$sth->execute($arr_package_1);
			$data_package_1 = $sth->fetchall();
			$package_1_name = array_map('array_pop', $data_package_1);
			$mssql_para['package'] .= implode(',', $package_1_name);
		} else {
			$mssql_para['package'] .= '無';
		}
		$mssql_para['package'] .= '。';

		// 高階項目
		$mssql_para['package'] .= '高階項目：';
		if(count($arr_package_2)>0){
			$sql_package_2 = 'SELECT name FROM health_package WHERE id IN (?'.(str_repeat(', ?', count($arr_package_2)-1)).')';
			$sth = $db->obj_pdo->prepare($sql_package_2);
			$sth->execute($arr_package_2);
			$data_package_2 = $sth->fetchall();
			$package_2_name = array_map('array_pop', $data_package_2);
			$mssql_para['package'] .= implode(',', $package_2_name);
		} else {
			$mssql_para['package'] .= '無';
		}
		$mssql_para['package'] .= '。';

		// 加項項目
		$mssql_para['package'] .= '加項項目：';
		if(count($arr_self_pay_item)>0){
			$sql_self_pay_item = 'SELECT name FROM self_pay_item WHERE id IN (?'.(str_repeat(', ?', count($arr_self_pay_item)-1)).')';
			$sth = $db->obj_pdo->prepare($sql_self_pay_item);
			$sth->execute($arr_self_pay_item);
			$data_self_pay_item = $sth->fetchall();
			$self_pay_item_name = array_map('array_pop', $data_self_pay_item);
			$mssql_para['package'] .= implode(',', $self_pay_item_name);
		} else {
			$mssql_para['package'] .= '無';
		}
		$mssql_para['package'] .= '。';

		// 問卷
		$mssql_para['Remark'] .= '懷孕婦女：'.(array_key_exists('pregnancy', $data)?($data['pregnancy']=='1'?'是':'否'):'未調查').'。';
		$mssql_para['Remark'] .= '是否有心血管疾病個人病史或家族病史：'.(array_key_exists('sick', $data)?($data['sick']=='1'?'是':'否'):'未調查').'。';
		$mssql_para['Remark'] .= '是否有吸菸：'.(array_key_exists('sick', $data)?($data['sick']=='1'?'是':'否'):'未調查').'。';
		$mssql_para['Remark'] .= '過去病史：'.(count($arr_heart_sick)==0?'無':implode(', ', $arr_heart_sick)).'。';
		$mssql_para['Remark'] .= '使用抗凝血劑：'.(count($arr_drug)==0?'無':implode(', ', $arr_drug)).'。';
		$mssql_para['Remark'] .= '藥物過敏史：'.(array_key_exists('allergy', $data)?$data['allergy']:'無').'。';
		$mssql_para['Remark'] .= '近三個月內住院原因：'.(array_key_exists('hospitalization', $data)?$data['hospitalization']:'無').'。';
		$mssql_para['Remark'] .= '備註：'.$data['memo'].'。';
		
		// 引用MS SQL用PDO
		include_once(__DIR__."/mssqldb.php");
		$mssqldb->doinsert('WEBPRE', $mssql_para);

		/*========寫入mssql========*/

//		/*========發送Mail========*/
//		// 從html產生信件內容
//		$arr_mail = array(
//			'id_type'=>$mssql_para['racecode'],
//			'name'=>$mssql_para['regname'],
//			'gender'=>$mssql_para['sex'],
//			'gender_name'=>$data['gender']=='1'?'先生':'小姐',
//			'identity'=>$mssql_para['id'],
//			'birthday'=>$mssql_para['dob'],
//			'resv_date_s'=>$mssql_para['preferdate1'],
//			'resv_date_e'=>$mssql_para['preferdate2'],
//			'tel_home'=>$mssql_para['tel1'],
//			'tel_office'=>$mssql_para['tel2'],
//			'fax'=>$mssql_para['fax'],
//			'mail'=>$mssql_para['email'],
//			'add_drug'=>$mssql_para['nowadd'],
//			'add_report'=>$mssql_para['reportaddr'],
//			'package_1_name'=>$_env['package_type']['1'],
//			'package_1'=>count($arr_package_1)>0?implode('、', $package_1_name):'',
//			'package_2_name'=>$_env['package_type']['2'],
//			'package_2'=>count($arr_package_2)>0?implode('、', $package_2_name):'',
//			'self_pay_item'=>count($arr_self_pay_item)>0?implode('、', $self_pay_item_name):'',
//			'price'=>$data['price'],
//			'memo'=>nl2br($data['memo']),
//		);
//		$mail_data = array(
//			"subject"=>"預約通知",
//			"body"=>read_mail_html('reservation', $arr_mail),
//			"send_mis"=>true,
//			"receive"=>array(
//				array("address"=>$mssql_para['email'], "name"=>$mssql_para['regname']),
//			),
//		);
//		unset($data);
//		unset($mssql_para);
//		send_mail($mail_data);
//
//		/*========發送Mail========*/

		unset($_SESSION[$_env['site_code'].'_recommand']);

		$result = array(
			'ok'=>'t',
		);
		break;
	
	case "contact":
		 $confirm = get_post('confirm');
		 if($_SESSION[$_env['site_code'].'_contact']!=$confirm) throw new Exception('驗證碼輸入錯誤');

		// 聯絡我們內容
		$sex = get_post('sex', '');
		$mssql_para = array(
			'regname' => get_post('regname', ''),
			'sex' => $sex=='1'?'男':'女',
			'tel1' => get_post('tel1', ''),
			'tel2' => get_post('tel2', ''),
			'mob' => get_post('mob', ''),
			'email' => get_post('email', ''),
			'Remark' => get_post('Remark', ''),
			'status' => '1',
			'InsDate' => Date('Y/m/d'),
		);

		if($mssql_para['regname']=='') throw new exception('請輸入姓名');
		if($mssql_para['tel1']==''&&$mssql_para['tel2']==''&&$mssql_para['mob']==''&&$mssql_para['email']=='') throw new exception('請輸入您的聯絡方式');
		if($mssql_para['email']!=''&&chk_is_mail($mssql_para['email'])===false) throw new exception('電子郵件格式錯誤');
		if($mssql_para['Remark']=='') throw new exception('請輸入留言內容');

		// 引用MS SQL用PDO
		include_once(__DIR__."/mssqldb.php");
		
		// 取得今年流水號的最大值
		$sql = 'SELECT ISNULL(MAX(examno), 0) AS examno FROM WebContact WHERE examno LIKE \''.(DATE('Y')-1911).'%\'';
		$data = $mssqldb->doselect_first($sql);
		if($data['examno']=='0') $mssql_para['examno'] = (DATE('Y')-1911).'100001';
		else {
			$max = intval(substr($data['examno'], 4))+1;
			$mssql_para['examno'] = (DATE('Y')-1911).'1'.str_repeat('0', 5-strlen($max)).$max;
		}

		$mssqldb->doinsert('WebContact', $mssql_para);

		$result = array(
			'ok'=>'t',
		);
		break;
}

} catch (exception $e){
	$result = array(
		"ok"=>"e",
		"msg"=>$e->getMessage()
	);
}

header('Content-Type: application/json');
echo json_encode($result);

?>