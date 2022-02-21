<?
$_baseenv['page_type'] = 'ajax';
include_once(__DIR__.'/local_parameter.php');
include_once(dirname(dirname(__DIR__)).'/include/adminclass.php');

try{

$fn = get_post('fn');
switch($fn){
	default:
		throw new exception('功能不存在');
		break;
	case "del":
		$para = array(
			'id'=>get_post('id', 0),
			'deled'=>'1',
		);
		$db->doupdate('sys_manager', 'where id = :id', $para, array('id'));
		$result = array(
			'ok'=>'t',
			'msg'=>'資料已刪除'
		);
		break;
}

} catch (exception $e){
	$result = array(
		'ok'=>'e',
		'msg'=>$e->getMessage()
	);
}

header('Content-Type: application/json');
echo json_encode($result);

?>