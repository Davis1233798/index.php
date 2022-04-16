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
//=========共用問卷=================
$_env['job_now']=array(
    '1'=>'061001|醫師',
    '2'=>'061002|牙醫師',
    '3'=>'061003|中醫師',
    '4'=>'061004|醫學美容／整型',
    '5'=>'061005|麻醉醫師',
    '6'=>'061006|臨床／諮商心理師',
    '7'=>'061007|職能治療師',
    '8'=>'061008|物理治療師',
    '9'=>'061009|語言治療師',
    '10'=>'061010|呼吸治療師',
    '11'=>'061011|獸醫／獸醫佐',
    '12'=>'061012|其它醫療從業人員',
    '13'=>'061101|護理長',
    '14'=>'061102|護士／護理師',
    '15'=>'061103|專科護理師',
    '16'=>'061104|照顧服務員',
    '17'=>'061105|勞工健康服務護理人員／廠護',
    '18'=>'061201|藥師助理',
    '19'=>'061202|診所助理',
    '20'=>'061203|牙醫助理',
    '21'=>'061204|醫院行政管理人員',
    '22'=>'061301|藥師',
    '23'=>'061302|營養師',
    '24'=>'061303|醫事檢驗師',
    '25'=>'061304|復健技術師',
    '26'=>'061305|醫事放射師',
    '27'=>'061306|驗光師',
    '28'=>'061307|牙體技術人員',
    '29'=>'061308|推拿／按摩師',
    '30'=>'061309|放射性設備使用技術員',
    '31'=>'061401|生技主管',
    '32'=>'061402|醫藥研發人員',
    '33'=>'061403|病理藥理研究人員',
    '34'=>'061404|生物科技研發人員',
    '35'=>'061405|醫療器材研發工程師',
);
//吸菸
$_env['smoke']=array(
    '1'=>'從未吸菸',
    '2'=>'偶爾吸(不是天天)',
    '3'=>'(幾乎)每天吸，平均每天吸'.'<input id="smoke_daily" type=number step=1 min="1" max="200" style="width:40px;" disabled/>'.'支，已吸'.'<input type=number id="smoke_year" step=1 min="1" max="99" style="width:35px;"disabled/>'.'年',
    '4'=>'已經戒菸，戒了'.'<input type=number id="smoke_fix_y" step=1 min="0" max="99" style="width:35px;"disabled/>'.'年'.'<input style="width:55px;" id="smoke_fix_m" type=number step=0.5 min="0.5" max="11.5"disabled/>'.'個月',
);

//檳榔
$_env['binlang']=array(
    '1'=>'從未嚼食檳榔',
    '2'=>'偶爾嚼(不是天天)',
    '3'=>'(幾乎)每天嚼，平均每天嚼'.'<input id="binlang_daily" type=number step=1 min="1" max="200" style="width:40px;" disabled/>'.'顆,已嚼'.'<input type=number id="binlang_year" step=1 min="0" max="99" style="width:35px;"disabled/>'.'年',
    '4'=>'已戒食，戒了'.'<input type=number id="binlang_fix_y" step=1 min="0" max="99" style="width:35px;"disabled/>'.'年'.'<input style="width:55px;" id="binlang_fix_m" type=number step=0.5 min="0.5" max="11.5"disabled/>'.'個月'

);

//喝酒
$_env['wine']=array(
    '1'=>'從未喝酒',
    '2'=>'偶爾喝(不是天天)',
    '3'=>'（幾乎）每天喝，平均每週喝'.'<input id="wine_weekly" type=number step=1 min="1" max="200" style="width:40px;" disabled/>'.'次,最常喝'.'<input type=plain id=wine_type  style="width:75px;" maxlength="5" disabled >'.'酒，每次'.'<input type=number id="wine_quota" step=0.5 min="0" max="99" style="width:35px;"disabled/>'.'瓶',
    '4'=>'已經戒酒，戒了'.'<input type=number id="wine_fix_y" step=1 min="0" max="99" style="width:35px;"disabled/>'.'年'.'<input style="width:55px;" id="wine_fix_m" type=number step=0.5 min="0.5" max="11.5"disabled/>'.'個月',
);
//===================================
//游離================================
//內分泌_過去病史_游離
$_env['endocrine_past_radiation']=array(
    '1'=>'甲狀腺結節、腫瘤',
    '2'=>'甲狀腺功能異常(亢進或低下)',
    '3'=>'無',
);

//血液_過去病史_游離
$_env['blood_past_radiation']=array(
    '1'=>'缺鐵性貧血',
    '2'=>'海洋性貧血',
    '3'=>'其他',
    '4'=>'無',
);

//肝_過去病史_游離
$_env['liver_past_radiation']=array(
    '1'=>'B型肝炎',
    '2'=>'C型肝炎',
    '3'=>'脂肪肝',
    '4'=>'酒精性肝炎',
    '5'=>'藥物性肝炎',
    '6'=>'無',
);

//其他_過去病史_游離
$_env['other_past_radiation']=array(
    '1'=>'生殖系統疾病(不孕、月經異常)',
    '2'=>'眼疾(白內障) ',
    '3'=>'皮膚病',
    '4'=>'高血壓',
    '5'=>'糖尿病'.'<br>',
    '6'=>'慢性腎臟病',
    '7'=>'心臟病',
    '8'=>'呼吸疾病',
    '9'=>'呼吸疾病',
    '10'=>'其他',
    '11'=>'無',
);

//內分泌_自覺症狀_游離
$_env['endocrine_self_radiation']=array(
    '1'=>'體重增加或減輕3公斤以上',
    '2'=>'心悸',
    '3'=>'便秘或腹瀉',
);

//血液_自覺症狀_游離
$_env['blood_self_radiation']=array(
    '1'=>'倦怠',
    '2'=>'頭暈',
);

//呼吸_自覺症狀_游離
$_env['breathe_self_radiation']=array(
    '1'=>'咳嗽',
    '2'=>'胸痛',
    '3'=>'呼吸困難',
);

//其他
$_env['other_self_radiation']=array(
    '1'=>'視力模糊',
    '2'=>'噁心',
    '3'=>'嘔吐',
    '4'=>'皮膚紅斑',
    '5'=>'女性月經異常',
    '6'=>'其他',
);
//==========================
//鉛作業=====================
//既往病史##########################
//心臟血管
$_env['past_heart_pb']=array(
    '1'=>'缺血性心臟病',
    '2'=>'心絞痛',
    '3'=>'心肌梗塞',
    '4'=>'貧血',
    '5'=>'高血壓',
    '6'=>'無',
);
//神經系統
$_env['past_nervous_pb']=array(
    '1'=>'手部運動神經病變',
    '2'=>'腳踝以下運動神經病變',
    '3'=>'無',
);

//消化系統
$_env['past_digestive_pb']=array(
    '1'=>'逆流性食道炎',
    '2'=>'腳踝以下運動神經病變',
    '3'=>'間歇性腹痛',
    '4'=>'無',
);
//生殖系統_男
$_env['past_rep_pb_men']=array(
    '1'=>'不孕',
    '2'=>'性功能障礙',
    '3'=>'無',
);
//生殖系統_女
$_env['past_rep_pb_women']=array(
    '1'=>'不孕',
    '2'=>'流產',
    '3'=>'早產',
    '4'=>'胎兒神經系統或發育問題',
    '5'=>'無',
);
//其他
$_env['past_other_pb']=array(
    '1'=>'糖尿病',
    '2'=>'腎臟疾病',
    '3'=>'其他',
    '4'=>'無',
);
//自覺=======================
//心臟血管
$_env['self_heart_pb']=array(
    '1'=>'運動時胸悶、胸痛',
    '2'=>'頭暈(尤其是久站或坐、蹲姿勢改為站立時)',
);
//神經系統
$_env['self_nervous_pb']=array(
    '1'=>'手腕以下肌肉無力，扣鈕釦感覺吃力',
    '2'=>'腳踝以下肌肉無力，穿拖鞋容易掉落',
);
//泌尿系統
$_env['self_urinary_pb']=array(
    '1'=>'尿量減少',
    '2'=>'水腫',
);
//消化系統
$_env['self_digestive_pb']=array(
    '1'=>'腹痛',
    '2'=>'便祕',
    '3'=>'腹瀉',
    '4'=>'噁心',
    '5'=>'嘔吐',
    '6'=>'食慾不振',
);
//生殖系統
$_env['self_rep_pb']=array(
    '1'=>'性功能障礙 <br> 女',
    '2'=>'經期不規則',
);
//##########################
//=========================
//甲醛_既往_呼吸
$_env['past_breathe_ho']=array(
    '1'=>'氣喘',
    '2'=>'過敏性鼻炎',
    '3'=>'慢性氣管炎、肺氣腫',
    '4'=>'無',
);
//甲醛_既往_皮膚
$_env['past_skin_ho']=array(
    '1'=>'氣喘',
    '2'=>'刺激性皮膚炎',
    '3'=>'過敏性皮膚炎',
    '4'=>'化學性灼傷',
    '5'=>'無',
);
//甲醛_過往_其他
$_env['past_other_ho']=array(
    '1'=>'其他',
    '2'=>'無',
);
//甲醛_自覺_呼吸
$_env['self_breathe_ho']=array(
    '1'=>'咳嗽',
    '2'=>'呼吸急促',
    '3'=>'胸悶',
    '4'=>'氣喘',
);
//甲醛_自覺_皮膚
$_env['self_skin_ho']=array(
    '1'=>'暴露部位皮膚紅腫、水泡、乾燥、刺痛、脫皮',
    '2'=>'眼睛刺激感',
    '3'=>'喉嚨刺激感',
    '4'=>'眼睛或喉嚨乾燥不舒服',
);
//甲醛_自覺_其他
$_env['self_other_ho']=array(
'1'=>'其他',
'2'=>'無'
);
//粉塵_既往_心臟
$_env['past_heart_dust']=array(
'1'=>'心臟疾病',
'2'=>'無',
);
//粉塵_既往_呼吸
$_env['past_breathe_dust']=array(
    '1'=>'肺結核',
    '2'=>'哮喘',
    '3'=>'肺塵症',
    '4'=>'無',
);
//粉塵_自覺_心臟
$_env['self_heart_dust']=array(
'1'=>'胸痛',
'2'=>'心悸亢進(作業時，步行時，安靜時)',
'3'=>'貧血',
);
//粉塵_自覺_呼吸
$_env['self_breathe_dust']=array(
'1'=>'呼吸困難',
'2'=>'咳嗽',
'3'=>'咳痰',
);

?>