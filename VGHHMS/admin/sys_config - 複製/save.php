<?
$_baseenv['page_type'] = 'page';
include_once(__DIR__.'/local_parameter.php');
include_once(dirname(dirname(__DIR__)).'/include/adminclass.php');
include_once($_env['site_admin_path'].'layout/header.php');
include_once($_env['site_admin_path'].'layout/footer.php');

try{

$fn = get_get('fn');
switch($fn){
	default:
		throw new exception('功能不存在');
		break;
	case "edit":
		$para = array(
			'site_title'=>get_post('txt_site_title'),
			'keywords'=>get_post('txt_keywords'),
			// 'mail_secure'=>get_post('rd_mail_secure'),
			// 'mail_host'=>get_post('txt_mail_host'),
			// 'mail_port'=>get_post('txt_mail_port'),
			// 'mail_auth'=>get_post('rd_mail_auth'),
			'mail_account'=>get_post('txt_mail_account'),
			'mail_receive'=>get_post('txt_mail_receive'),
			'mail_sendaddress'=>get_post('txt_mail_sendaddress'),
			// 'mail_sendname'=>get_post('txt_mail_sendname'),
		);
		
		$mail_password = get_post('txt_mail_password');
		if($mail_password!='') $para['mail_password'] = $mail_password;
		
		$db->doupdate('sys_config', 'where id = 1', $para);
		
		$msg = '資料已修改';
		break;
}

} catch (exception $e){
	echo '<script>sys_back_message("', $e->getMessage(), '");</script>';
	return;
}

echo '<script>sys_show_message("', $msg, '", "index.php", true);</script>';

?>