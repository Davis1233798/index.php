<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");
include_once($_env["site_admin_path"]."layout/footer.php");

try{

$fn = get_get("fn");
switch($fn){
	default:
		throw new exception("功能不存在");
		break;
	case "add":
		$para = array(
			"sort"=>0,
			"inuse"=>get_post("rd_inuse", 0),
		);
		
		if(!$_FILES["f_filename"]["name"]) throw new exception("請選擇圖片");
		if(getimagesize($_FILES["f_filename"]["tmp_name"])===false) throw new exception("必需使用圖片檔案");
		
		$filename = upload_file($_FILES["f_filename"], $_env["site_upload_path"]."banner/");
		if($filename===false) throw new exception("圖片上傳失敗");
		$para["filename"] = $filename;
		
		$lastid = $db->doinsert("banner", $para);

		// 寫入排序
		$sql = 'SELECT IFNULL(MAX(sort), 0)+1 AS sort FROM banner';
		$data = $db->doselect_first($sql);
		$para = array(
			'id'=>$lastid,
			'sort'=>$data['sort'],
		);
		$db->doupdate('banner', 'WHERE id = :id', $para, array('id'));
		
		$msg = "資料已新增";
		break;
	case "edit":
		$para = array(
			"id"=>get_post("hdf_id", 0),
			"inuse"=>get_post("rd_inuse", 0),
		);
		
		if($_FILES["f_filename"]["name"]) {
			if(getimagesize($_FILES["f_filename"]["tmp_name"])===false) throw new exception("必需使用圖片檔案");
			
			$filename = upload_file($_FILES["f_filename"], $_env["site_upload_path"]."banner/");
			if($filename===false) throw new exception("圖片上傳失敗");
			
			$para["filename"] = $filename;
			$ori_file = $_env["site_upload_path"]."banner/".get_post("hdf_filename");
			if(file_exists($ori_file)&&is_file($ori_file)) unlink($ori_file);
		}
		
		$db->doupdate("banner", "where id = :id", $para, array("id"));
		
		$msg = "資料已修改";
		break;
}

} catch (exception $e){
	echo '<script>sys_back_message("'.$e->getMessage().'");</script>';
	return;
}

echo '<script>sys_show_message("'.$msg.'", "index.php", true);</script>';

?>