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
	case "del":
		$id = get_post("id", 0);
		
		$db->dodelete("faq_category", "id", array($id));
		
		$result = array(
			"ok"=>"t",
			"msg"=>"資料已刪除"
		);
		break;
	case "img_sort":		
		$id = get_post("id", 0);
		$news_id = get_post("news_id", 0);
		$sort_diff = get_post("sort_diff", 0);

		$db->dosort('news_img', 'id', 'sort', $id, $sort_diff, 'news_id', $news_id);
		
		$result = array(
			"ok"=>"t",
		);
		break;
	case "del_img":
		$id = get_post("id", 0);
		$sql = "SELECT news_id, filename, sort FROM news_img WHERE id = :id";
		$data = $db->doselect_first($sql, array("id"=>$id));
		
		if($data){
			// 將排序在後面的輪播圖往前移
			$para = array(
				'news_id'=>$data['news_id'],
				'sort'=>$data['sort'],
			);
			$sql = 'UPDATE news_img SET sort = sort - 1 WHERE news_id = :news_id AND sort > :sort';
			$db->doexe($sql, $para);

			$file = $_env["site_upload_path"]."news/".$data["news_id"]."/".$data["filename"];
			if(file_exists($file)&&is_file($file)) unlink($file);
		}
		
		$db->dodelete("news_img", "id", array($id));
		$result = array(
			"ok"=>"t",
			"msg"=>"檔案已刪除"
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