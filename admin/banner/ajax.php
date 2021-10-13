<?
$_baseenv["page_type"] = "ajax";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");

try{

$fn = get_post("fn");
switch($fn){
	default:
		throw new exception("功能不存在");
		break;
	case "index_sort":		
		$id = get_post("id", 0);
		$sort_diff = get_post("sort_diff", 0);

		$db->dosort('banner', 'id', 'sort', $id, $sort_diff);
		
		$result = array(
			"ok"=>"t",
		);
		break;
	case "del":		
		$id = get_post("id", 0);
		$sql = "SELECT sort, filename FROM banner WHERE id = :id";
		$data = $db->doselect_first($sql, array("id"=>$id));
		
		if($data){
			// 將排序在後面的資料往前移
			$sql = 'UPDATE banner SET sort = sort - 1 WHERE sort > :sort';
			$db->doexe($sql, array('sort'=>$data['sort']));

			$ori_file = $_env["site_upload_path"]."banner/".$data["filename"];
			if(file_exists($ori_file)&&is_file($ori_file)) unlink($ori_file);
		}
		
		$db->dodelete("banner", "id", array($id));
		$result = array(
			"ok"=>"t",
			"msg"=>"資料已刪除"
		);
		break;
}

} catch (exception $e){
	$result = array(
		"ok"=>"e",
		"msg"=>$e->getMessage()
	);
}

header('Content-Type: application/json');
echo json_encode($result);

?>