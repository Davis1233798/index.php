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
		$class_id = get_post("sel_class");

		$para = array(
			"id"=>$id,
			"class_id"=>$class_id,
			"name"=>get_post("txt_name"),
			"workday"=>get_post("txt_workday"),
			"price"=>get_post("txt_price"),
			'inuse'=>get_post('rd_inuse', 0),
			"show_flow"=>get_post("rd_show_flow", 0),
		);
		if($para["name"]=='') throw new exception("請輸入組套名稱");
		if($para["workday"]=='') throw new exception("請輸入執行日期");
		if($para["price"]=='') throw new exception("請輸入費用");
		
		if($_FILES["f_pdfname"]["name"]) {
			if(mime_content_type($_FILES["f_pdfname"]["tmp_name"])!="application/pdf") throw new exception("必需使用PDF檔案");
			
			$pdfname = upload_file($_FILES["f_pdfname"], $_env["site_upload_path"]."health_package/");
			if($pdfname===false) throw new exception("PDF上傳失敗");
			
			$para["pdfname"] = $pdfname;
			$ori_file = mb_convert_encoding($_env["site_upload_path"]."health_package/".get_post("hdf_pdfname"), 'big5', 'utf8');
			if(file_exists($ori_file)&&is_file($ori_file)) unlink($ori_file);
		}
		
		$msg = "資料已修改";

		// 檢查是否有變更類別，若有變更，則類別後面資料的排序往前，並將這筆資料的排序設為新類別的最後一筆
		$ori_class_id = get_post("hdf_class_id");
		if($class_id!=$ori_class_id){
			$para_sort = array(
				'id'=>$id,
			);
			$sql = 'SELECT sort FROM health_package WHERE id = :id';
			$data_sort = $db->doselect_first($sql, $para_sort);
			// 將原分類排序在後面的資料往前移
			$para_sort = array(
				'class_is'=>$ori_class_id,
				'sort'=>$data_sort['sort'],
			);
			$sql = 'UPDATE health_package SET sort = sort - 1 WHERE class_id = :class_is AND sort > :sort';
			$db->doexe($sql, $para_sort);

			// 取得在新分類的排序
			$sql = 'SELECT IFNULL(MAX(sort), 0)+1 AS sort FROM health_package WHERE class_id = :class_id';
			$data_sort = $db->doselect_first($sql, array('class_id'=>$class_id));
			$para['sort']= $data_sort['sort'];
		}
		
		$db->doupdate("health_package", "where id = :id", $para, array("id"));

		// 更新流程
		$sql = 'SELECT f_id FROM health_package_with_flow WHERE p_id = :id ORDER BY f_id';
		$data_flow = $db->doselect($sql, array('id'=>$id));
		foreach($data_flow as $row){
			$para_flow = array(
				'p_id'=>$id,
				'f_id'=>$row['f_id'],
				'inuse'=>get_post("rd_show_flow_".$row['f_id'], 0),
			);
			$db->doupdate("health_package_with_flow", "where p_id = :p_id AND f_id = :f_id ", $para_flow, array('p_id', 'f_id'));
		}
		
		break;
}

} catch (exception $e){
	echo '<script>sys_back_message("'.$e->getMessage().'");</script>';
	return;
}

echo '<script>sys_show_message("'.$msg.'", "index.php", true);</script>';

?>