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
			"start_date"=>get_post("txt_start_date"),
			"end_date"=>get_post("txt_end_date"),
			"sort"=>get_post("txt_sort"),
			"title"=>get_post("txt_title"),
			"en_title"=>get_post("txt_en_title"),
			"inuse"=>get_post("rd_inuse", 0),
			"default_img"=>get_post("sel_default"),
			"content"=>strip_tags($_POST["txt_content"]),
			"en_content"=>strip_tags($_POST["txt_en_content"]),
		);
		
		if($para["start_date"]=='') throw new exception("請選擇上架日期");
		if(!chk_is_date($para["start_date"])) throw new exception("上架日期格式錯誤");
		// if($para["end_date"]=='') throw new exception("請選擇下架日期");
		// if(!chk_is_date($para["end_date"])) throw new exception("下架日期格式錯誤");
		if($para["title"]=='') throw new exception("請輸入標題");
		// if($para["en_title"]=='') throw new exception("請輸入英文標題");
		
		//列表圖
		if($_FILES["f_filename"]["name"]) {
			$filename = upload_file($_FILES["f_filename"], $_env["site_upload_path"]."news/");
			if($filename===false) throw new exception("列表圖片上傳失敗");
			$para["filename"] = $filename;
		}
			
		//內頁圖
		if($_FILES["f_img"]["name"]) {
			$img = upload_file($_FILES["f_img"], $_env["site_upload_path"]."news/");
			if($img===false) throw new exception("內頁圖片上傳失敗");
			$para["img"] = $img;
		}
		
		$lastid = $db->doinsert("news", $para);//寫入資料，取得id
		
		$msg = "資料已新增";
		
		break;
	case "edit":
		$para = array(
			"id"=>get_post("hdf_id", 0),
			"start_date"=>get_post("txt_start_date"),
			"end_date"=>get_post("txt_end_date"),
			"sort"=>get_post("txt_sort"),
			"title"=>get_post("txt_title"),
			"en_title"=>get_post("txt_en_title"),
			"inuse"=>get_post("rd_inuse", 0),
			"default_img"=>get_post("sel_default"),
			"content"=>strip_tags($_POST["txt_content"]),
			"en_content"=>strip_tags($_POST["txt_en_content"]),
		);
		
		if($para["start_date"]=='') throw new exception("請選擇上架日期");
		if(!chk_is_date($para["start_date"])) throw new exception("上架日期格式錯誤");
		// if($para["end_date"]=='') throw new exception("請選擇下架日期");
		// if(!chk_is_date($para["end_date"])) throw new exception("下架日期格式錯誤");
		if($para["title"]=='') throw new exception("請輸入標題");
		// if($para["en_title"]=='') throw new exception("請輸入英文標題");
		
		//列表圖
		if($_FILES["f_filename"]["name"]) {
			if(getimagesize($_FILES["f_filename"]["tmp_name"])===false) throw new exception("必需使用圖片檔案");
			
			$filename = upload_file($_FILES["f_filename"], $_env["site_upload_path"]."news/");
			if($filename===false) throw new exception("列表圖片上傳失敗");
			
			$para["filename"] = $filename;
			$ori_file = $_env["site_upload_path"]."news/".get_post("hdf_filename");
			if(file_exists($ori_file)&&is_file($ori_file)) unlink($ori_file);
		}

		//內頁圖
		if($_FILES["f_img"]["name"]) {
			if(getimagesize($_FILES["f_img"]["tmp_name"])===false) throw new exception("必需使用圖片檔案");
			
			$img = upload_file($_FILES["f_img"], $_env["site_upload_path"]."news/");
			if($img===false) throw new exception("內頁圖片上傳失敗");
			
			$para["img"] = $img;
			$ori_file = $_env["site_upload_path"]."news/".get_post("hdf_img");
			if(file_exists($ori_file)&&is_file($ori_file)) unlink($ori_file);
		}

		
		$msg = "資料已修改";
		
		$db->doupdate("news", "where id = :id", $para, array("id"));
		
		break;
}

} catch (exception $e){
	echo '<script>sys_back_message("'.$e->getMessage().'");</script>';
	return;
}

echo '<script>sys_show_message("'.$msg.'", "index.php", true);</script>';

?>