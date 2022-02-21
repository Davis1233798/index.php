<?
	include(__DIR__.'/parameter.php');
	
	// 關閉錯誤顯示
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(0);
	
	// 啟用session
	session_start ();

	// 設定編碼
	// header('charset=UTF-8');
	
	// 設定時區
	date_default_timezone_set($_env['site_timezone']);
	
	// 使用自定義pdo
	include(__DIR__.'/mydb.php');
	
	// 使用自定義功能
	if(!array_key_exists('comm_fn', $_baseenv)||$_baseenv['comm_fn']!==false) include(__DIR__.'/comm_fn.php');

	// 從資料庫讀取網站title/descciption/keyword
	$sql = 'select `site_title`, `description`, `keywords` FROM `sys_config` ';
	$data = $db->doselect_first($sql);
	$_env['site_title'] = $data['site_title'];
	$_env['site_desc'] = $data['description'];
	$_env['site_kword'] = $data['keywords'];
	unset($sql);
	unset($data);

	$_env['package_type'] = array(
		'1'=>'健檢組套',
		'2'=>'高階檢查',
	);

	// 病史
	$_env['heart_sick'] = array(
		'1'=>'經心導管手術支架置入',
		'2'=>'心臟瓣膜置換手術',
		'3'=>'經心臟去顫器置入',
		'4'=>'裝置心律調節器者',
		'5'=>'其他',
		'6'=>'嚴重的肺氣腫',
		'7'=>'重度氣喘',
		'8'=>'重度肺動脈高壓',
		'9'=>'腦部病（如腦中風、腦部腫瘤、腦血管動靜脈畸形瘤、癲癇、近期腦外傷）',
		'10'=>'慢性腎臟病（洗腎）',
		'11'=>'肝硬化',
		'12'=>'腸阻塞',
		'13'=>'重度呼吸終止症候群',
	);

	// 抗擬血劑
	$_env['drug'] = array(
		'1'=>'Coumadin(Warfarin)',
		'2'=>'Aspirin(阿斯匹靈)',
		'3'=>'Licodin(利血達)',
		'4'=>'Brilinta(百無凝)',
		'5'=>'Pradaxa(普栓達)',
		'6'=>'XareLto(拜瑞妥)',
		'7'=>'Apixaban(艾必克凝)',
		'8'=>'Lixiana(里先安)',
		'9'=>'Plavix(保栓通)',		
	);

	// 健檢身分
	$_env['id_type'] = array(
		'1'=>'個人',
		'2'=>'榮民',
		'3'=>'遺眷',
		'4'=>'公教人員(須現職公務人員)',
		'5'=>'本院員工及眷屬',
		'6'=>'其他',
		'7'=>'簽約團體',
	);



?>