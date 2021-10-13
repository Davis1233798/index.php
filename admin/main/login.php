<?

include_once(dirname(dirname(__DIR__)).'/include/adminclass.php');

$acc = get_post('acc');
$psd = get_post('psd');
$confirm = get_post('confirm');
$remember = get_post('remember');

try{
	$deadline = do_check_deadline();
	if($deadline['status']===4){
		do_logout();
		throw new Exception($deadline['msg']);
	}

	if(!$acc) throw new Exception('請輸入帳號');
	if(!$psd) throw new Exception('請輸入密碼');
	if(!$confirm) throw new Exception('請輸入驗證碼');
	
	if($_SESSION[$_env['site_code'].'_admin_login']!=$confirm) throw new Exception('驗證碼輸入錯誤');
	if(!do_check_login($acc, $psd)) throw new Exception('帳號或密碼輸入錯誤');

	if($remember=='1'){
		setcookie($_env['site_code'].'_loginpage_acc', $acc, time()+intval($_env['setting_login_remember']), '/');
		setcookie($_env['site_code'].'_loginpage_psd', $psd, time()+intval($_env['setting_login_remember']), '/');
	} else {
		setcookie($_env['site_code'].'_loginpage_acc', NULL, time(), '/');
		setcookie($_env['site_code'].'_loginpage_psd', NULL, time(), '/');
	}
	
	$result = array(
		'ok'=>'t',
	);
	
} catch(Exception $e){
	$result = array(
		'ok'=>'e',
		'msg'=>$e->getMessage()
	);
}

header('Content-Type: application/json');
echo json_encode($result);

?>