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
		throw new exception("功能不存在");
		break;
	case 'add':
		$para = array(
			'acc'=>get_post('txt_acc'),
			'name'=>get_post('txt_name'),
			'auth'=>'|'.implode('||', $_POST['chk_auth']).'|',
			'inuse'=>get_post('rd_inuse', 0),
			'deled'=>'0',
		);
		$psd = get_post('txt_psd');
		$psd2 = get_post('txt_psd2');
		
		if($para['acc']=='') throw new exception('請輸入帳號');
		if($db->docheckexist('sys_manager', array('acc'=>$para['acc'], 'deled'=>'0'))) throw new exception('帳號已存在');// 檢查帳號重複
		if($psd=='') throw new exception('請輸入密碼');
		if(strlen($psd)<4) throw new exception('密碼至少四位數');
		if($psd2=='') throw new exception('請再次輸入密碼');
		if($psd!=$psd2) throw new exception('兩次輸入的密碼不同');
		
		$para['psd'] = md5($psd);
		if($para['auth']=='||') $para['auth'] = '';
		$db->doinsert('sys_manager', $para);
		$msg = '資料已新增';
		break;
	case 'edit':
		$para = array(
			'id'=>get_post('hdf_id'),
			'name'=>get_post('txt_name'),
			'auth'=>'|'.implode('||', $_POST['chk_auth']).'|',
			'inuse'=>get_post('rd_inuse', 0),
		);
		
		// 若為admin，則無法修改密碼，啟用固定開啟
		if($para['id']=='1'){
			$para['inuse'] = '1';
			unset($para['auth']);
		} else {
			$psd = get_post('txt_psd');
			$psd2 = get_post('txt_psd2');
			
			if($psd!=''||$psd2!=''){
				if($psd=='') throw new exception('請輸入密碼');
				if(strlen($psd)<4) throw new exception('密碼至少四位數');
				if($psd2=='') throw new exception('請再次輸入密碼');
				if($psd!=$psd2) throw new exception('兩次輸入的密碼不同');
				$para['psd'] = md5($psd);
			}
		
			if($para['auth']=='||') $para['auth'] = '';
		}
		
		$db->doupdate('sys_manager', 'where id = :id', $para, array('id'));
		
		if($para['psd']!=''&&$_SESSION['manager_login']['id']==$para['id']){
			$_SESSION['manager_login']['psd'] = $para['psd'];
		}
		
		$msg = '資料已修改';
		break;
}

} catch (exception $e){
	echo '<script>sys_back_message("'.$e->getMessage().'");</script>';
	return;
}

echo '<script>sys_show_message("'.$msg.'", "index.php", true);</script>';

?>