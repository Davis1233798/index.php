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
			"sort"=>get_post("txt_sort"),
			"name"=>get_post("txt_name"),
			"en_name"=>get_post("txt_en_name"),
			"category_id"=>get_post("sel_category_id"),
			"category_en"=>get_post("sel_category_en"),
			"gender"=>get_post("sel_gender"),
			"division"=>get_post("txt_division"),
			"en_division"=>get_post("txt_en_division"),
			"url"=>get_post("txt_url"),
			"edu"=>strip_tags($_POST["txt_edu"]),
			"en_edu"=>strip_tags($_POST["txt_en_edu"]),
			"exp"=>strip_tags($_POST["txt_exp"]),
			"en_exp"=>strip_tags($_POST["txt_en_exp"]),
			"spec"=>strip_tags($_POST["txt_spec"]),
			"en_spec"=>strip_tags($_POST["txt_en_spec"]),
			"job"=>strip_tags($_POST["txt_job"]),
			"en_job"=>strip_tags($_POST["txt_en_job"]),
			"license"=>strip_tags($_POST["txt_license"]),
			"en_license"=>strip_tags($_POST["txt_en_license"]),
			"inuse"=>get_post("rd_inuse", 0),
		);

		if($para["name"]=='') throw new exception("請輸入姓名");
		if($para["division"]=='') throw new exception("請輸入科別");
		
		//大頭照
		if($_FILES["f_filename"]["name"]) {
			$filename = upload_file($_FILES["f_filename"], $_env["site_upload_path"]."team/");
			if($filename===false) throw new exception("圖片上傳失敗");
			$para["filename"] = $filename;
		}

		$lastid = $db->doinsert("team", $para);//寫入資料，取得id
		
		$msg = "資料已新增";
		
		break;
	case "edit":
		$para = array(
			"id"=>get_post("hdf_id", 0),
			"sort"=>get_post("txt_sort"),
			"name"=>get_post("txt_name"),
			"en_name"=>get_post("txt_en_name"),
			"category_id"=>get_post("sel_category_id"),
			"category_en"=>get_post("sel_category_en"),
			"gender"=>get_post("sel_gender"),
			"division"=>get_post("txt_division"),
			"en_division"=>get_post("txt_en_division"),
			"url"=>get_post("txt_url"),
			"edu"=>strip_tags($_POST["txt_edu"]),
			"en_edu"=>strip_tags($_POST["txt_en_edu"]),
			"exp"=>strip_tags($_POST["txt_exp"]),
			"en_exp"=>strip_tags($_POST["txt_en_exp"]),
			"spec"=>strip_tags($_POST["txt_spec"]),
			"en_spec"=>strip_tags($_POST["txt_en_spec"]),
			"job"=>strip_tags($_POST["txt_job"]),
			"en_job"=>strip_tags($_POST["txt_en_job"]),
			"license"=>strip_tags($_POST["txt_license"]),
			"en_license"=>strip_tags($_POST["txt_en_license"]),
			"inuse"=>get_post("rd_inuse", 0),
		);

		if($para["name"]=='') throw new exception("請輸入姓名");
		if($para["division"]=='') throw new exception("請輸入科別");

		//大頭照
		if($_FILES["f_filename"]["name"]) {
			if(getimagesize($_FILES["f_filename"]["tmp_name"])===false) throw new exception("必需使用圖片檔案");
			
			$filename = upload_file($_FILES["f_filename"], $_env["site_upload_path"]."team/");
			if($filename===false) throw new exception("圖片上傳失敗");
			
			$para["filename"] = $filename;
			$ori_file = $_env["site_upload_path"]."team/".get_post("hdf_filename");
			if(file_exists($ori_file)&&is_file($ori_file)) unlink($ori_file);
		}

		$msg = "資料已修改";
		
		$db->doupdate("team", "where id = :id", $para, array("id"));
		
		break;
}

} catch (exception $e){
	echo '<script>sys_back_message("'.$e->getMessage().'");</script>';
	return;
}

echo '<script>sys_show_message("'.$msg.'", "index.php", true);</script>';

?>