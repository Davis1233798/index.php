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
			"name"=>get_post("txt_name"),
		);
		if($para["name"]=='') throw new exception("請輸入自費類別名稱");
		
		$msg = "資料已修改";
		
		$db->doupdate("self_pay_item_class", "where id = :id", $para, array("id"));
		
		break;
}

} catch (exception $e){
	echo '<script>sys_back_message("'.$e->getMessage().'");</script>';
	return;
}

echo '<script>sys_show_message("'.$msg.'", "index.php", true);</script>';

?>