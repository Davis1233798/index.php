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
	case "edit":
		$id = get_post("hdf_id", 0);

		$para = array(
			"id"=>$id,
			"type"=>get_post("sel_type"),
			"name"=>get_post("txt_name"),
		);
		if($para["name"]=='') throw new exception("請輸入健檢類別名稱");
		
		$msg = "資料已修改";
		
		// 若有選個案主圖，則更新個案主圖
		if($_FILES["f_filename"]["name"]){
			$filename1 = upload_file($_FILES["f_filename"], $_env["site_upload_path"]."health_package_class/".$id."/");
			if($filename1===false) $msg .= "，個案主圖上傳失敗";
			else {
				$para["filename"] = $filename1;
				$ori_file1 = $_env["site_upload_path"]."health_package_class/".$id."/".get_post("hdf_filename");
				if(file_exists($ori_file1)&&is_file($ori_file1)) unlink($ori_file1);
			}
		}
		
		if($_FILES["f_pdfname"]["name"]) {
			if(mime_content_type($_FILES["f_pdfname"]["tmp_name"])!="application/pdf") throw new exception("必需使用PDF檔案");
			
			$pdfname = upload_file($_FILES["f_pdfname"], $_env["site_upload_path"]."health_package_class/".$id."/");
			if($pdfname===false) throw new exception("PDF上傳失敗");
			
			$para["pdfname"] = $pdfname;
			$ori_file = mb_convert_encoding($_env["site_upload_path"]."health_package_class/".$id."/".get_post("hdf_pdfname"), 'big5', 'utf8');
			if(file_exists($ori_file)&&is_file($ori_file)) unlink($ori_file);
		}
		
		$db->doupdate("health_package_class", "where id = :id", $para, array("id"));
		
		break;
}

} catch (exception $e){
	echo '<script>sys_back_message("'.$e->getMessage().'");</script>';
	return;
}

echo '<script>sys_show_message("'.$msg.'", "index.php", true);</script>';

?>