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

		$para = array(
			'id'=>$id,
		);
		$sql = 'SELECT class_id, sort FROM health_package WHERE id = :id';
		$data = $db->doselect_first($sql, $para);

		if($sort_diff>0){
			// 若排序數字變大，檢查是否超過此分類的最大值
			$para = array('class_id'=>$data['class_id']);
			$sql = 'SELECT MAX(sort) AS sort FROM health_package WHERE class_id = :class_id';
			$data_class = $db->doselect_first($sql, $para);

			if((int)$data['sort']+(int)$sort_diff>(int)$data_class['sort']) throw new exception('排序不可超過分類最大值');
		} else if($sort_diff<0&&(int)$data['sort']+(int)$sort_diff<=0){
			// 若排序數字變小，檢查是否排序會小於1
			throw new exception('排序不可小於分類最小值');
		}

		$db->dosort('health_package', 'id', 'sort', $id, $sort_diff, 'class_id', $data['class_id']);

		$result = array(
		"ok"=>"t",
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