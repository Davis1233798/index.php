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
    //內分泌_過去病史
    $env['endocrine_past']=array(
        '1'=>'甲狀腺結節、腫瘤',
        '2'=>'甲狀腺功能異常(亢進或低下)',
        '3'=>'無',
    );
    //血液_過去病史
    $env['blood_past']=array(
        '1'=>'缺鐵性貧血',
        '2'=>'海洋性貧血',
        '3'=>'其他',
        '4'=>'無',
    );
    //肝_過去病史
    $env['liver_past']=array(
        '1'=>'B型肝炎',
        '2'=>'C型肝炎',
        '3'=>'脂肪肝',
        '4'=>'酒精性肝炎',
        '5'=>'藥物性肝炎',
        '6'=>'無',
    );
    //其他_過去病史
    $env['survey_past_else']=array(
        '1'=>'生殖系統疾病(不孕、女性月經異常)',
        '2'=>'眼疾(白內障) ',
        '3'=>'皮膚病',
        '4'=>'高血壓',
        '5'=>'糖尿病',
        '6'=>'慢性腎臟病',
        '7'=>'心臟病',
        '8'=>'呼吸疾病',
        '9'=>'呼吸疾病',
        '10'=>'其他',
        '11'=>'無',
    );
    //吸菸
    $env['smoke']=array(
        '1'=>'從未吸菸',
        '2'=>'偶爾吸(不是天天)',
        '3'=>'(幾乎)每天吸，平均每天吸  支，已吸菸  年',
        '4'=>'已經戒菸，戒了   年   個月',
    );
    //檳榔
    $env['binlang']=array(
        '1'=>'從未嚼食檳榔',
        '2'=>'偶爾嚼(不是天天)',
        '3'=>'(幾乎)每天嚼，平均每天嚼__顆，已嚼  年',
        '4'=>'已經戒食，戒了   年   個月',
    );
    //喝酒
    $env['wine']=array(
        '1'=>'從未喝酒',
        '2'=>'偶爾喝(不是天天)',
        '3'=>'（幾乎）每天喝，平均每週喝   次，最常喝____酒，每次___瓶',
        '4'=>'已經戒酒，戒了   年   個月',
    );
    //內分泌_自覺症狀
    $env['endocrine_self']=array(
        '1'=>'體重增加或減輕3公斤以上',
        '2'=>'心悸',
        '3'=>'便秘或腹瀉',
    );
    //血液_自覺症狀
    $env['blood_self']=array(
        '1'=>'體重增加或減輕3公斤以上',
        '2'=>'心悸',
        '3'=>'便秘或腹瀉',
    );

?>