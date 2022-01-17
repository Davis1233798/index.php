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
		$para = array();

		if($_FILES["f_filename"]["name"]) {
			$filename = upload_file($_FILES["f_filename"], $_env["site_upload_path"]."about/");
			if($filename===false) throw new exception("圖片上傳失敗");
			$para["filename"] = $filename;
		}
		
		$db->doupdate('about', 'where id = 1', $para);
		
		$msg = '資料已修改';
		break;
}

} catch (exception $e){
	echo '<script>sys_back_message("', $e->getMessage(), '");</script>';
	return;
}

echo '<script>sys_show_message("', $msg, '", "index.php", true);</script>';

?>