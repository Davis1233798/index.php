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
			"price"=>get_post("txt_price"),
			'inuse'=>get_post('rd_inuse', 0),
		);
		if($para["name"]=='') throw new exception("請輸入項目名稱");
		if($para["price"]=='') throw new exception("請輸入費用");
		
		$msg = "資料已修改";

		// 檢查是否有變更類別，若有變更，則類別後面資料的排序往前，並將這筆資料的排序設為新類別的最後一筆
		$ori_class_id = get_post("hdf_class_id");
		if($class_id!=$ori_class_id){
			$para_sort = array(
				'id'=>$id,
			);
			$sql = 'SELECT sort FROM self_pay_item WHERE id = :id';
			$data_sort = $db->doselect_first($sql, $para_sort);
			// 將原分類排序在後面的資料往前移
			$para_sort = array(
				'class_is'=>$ori_class_id,
				'sort'=>$data_sort['sort'],
			);
			$sql = 'UPDATE self_pay_item SET sort = sort - 1 WHERE class_id = :class_is AND sort > :sort';
			$db->doexe($sql, $para_sort);

			// 取得在新分類的排序
			$sql = 'SELECT IFNULL(MAX(sort), 0)+1 AS sort FROM self_pay_item WHERE class_id = :class_id';
			$data_sort = $db->doselect_first($sql, array('class_id'=>$class_id));
			$para['sort']= $data_sort['sort'];
		}
		
		$db->doupdate("self_pay_item", "where id = :id", $para, array("id"));
		
		break;
}

} catch (exception $e){
	echo '<script>sys_back_message("'.$e->getMessage().'");</script>';
	return;
}

echo '<script>sys_show_message("'.$msg.'", "index.php", true);</script>';

?>