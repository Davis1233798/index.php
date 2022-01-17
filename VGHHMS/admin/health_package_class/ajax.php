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

		$db->dosort('health_package_class', 'id', 'sort', $id, $sort_diff);
		
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