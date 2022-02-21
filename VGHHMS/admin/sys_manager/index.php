<?
$_baseenv['page_type'] = 'page';
include_once(__DIR__.'/local_parameter.php');
include_once(dirname(dirname(__DIR__)).'/include/adminclass.php');
include_once($_env['site_admin_path'].'layout/header.php');

?>
<body class="navbar-fixed sidebar-nav fixed-nav">
<? include_once($_env['site_admin_path'].'layout/navbar.php'); ?>
<? include_once($_env['site_admin_path'].'layout/sidebar.php'); ?>

<main class="main">
<div class="container-fluid">
<!-- 頁面內容 -->

<?
	$page = get_post('p', 1);
	$qry_keyword = get_post('txt_keyword');
	$para = array();
	$order = array('acc'=>'a', 'id'=>'a');
	$sql = 'SELECT id, acc, name, inuse FROM sys_manager WHERE deled = 0 ';
	if($qry_keyword!=''){
		$para['keyword'] = '%'.$qry_keyword.'%';
		$sql .= 'AND (name like :keyword or acc like :keyword) ';
	}
	$query = $db->doselect_page($sql, $para, $order, $page);
	
?>
<div class="container-fluid">
<div class="animated fadeIn">
<div class="row row-equal">
<div class="row">
<div class="col-lg-12">
<div class="card">
	<div class="card-header">
		<? echo $_pageenv['fn_name']; ?>
	</div>
	<div class="card-block">
	
		<div class="card-block">
			<form id="index_qry_form" method="POST">
				<div class="col-md-8">
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="text-input">關鍵字搜尋</label>
						<div class="col-md-8">
							<input type="text" id="txt_keyword" name="txt_keyword" class="form-control" value="<? echo $qry_keyword; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group row">
						<button type="submit" class="btn btn-sm btn-secondary"><i class="fa fa-search"></i> 查詢</button>
						<button type="button" class="btn btn-sm btn-success" onclick="location.href='add.php'"><i class="fa fa-plus"></i> 新增</button>
					</div>
				</div>
			</form>
		</div>
		<table class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th>使用者帳號</th>
					<th>使用者名稱</th>
					<th>啟用狀態</th>
					<th width="20%"></th>
				</tr>
			</thead>
			<tbody>
				<? foreach($query['data'] as $row){ ?>
					<tr id="tr_<? echo $row['id'] ?>">
						<td><? echo $row['acc'] ?></td>
						<td><? echo $row['name'] ?></td>
						<td>
							<? if($row['inuse']=='1'){ ?><span class="label label-success">啟用</span><? } ?>
							<? if($row['inuse']=='0'){ ?><span class="label label-default">停用</span><? } ?>
						</td>
						<td>
							<button type="button" class="btn btn-primary" onclick="javascript:location.href='edit.php?id=<? echo $row['id'] ?>'">編輯</button>
							<button type="button" class="btn btn-danger" onclick="index_del_data(<? echo $row['id'] ?>)" <? echo ($row['id']==$_SESSION[$_env['site_code'].'_manager_login']['id']||$row['id']=='1')?'disabled':''; ?>>刪除</button>
						</td>
					</tr>
				<? } ?>
			</tbody>
		</table>
		<? create_pager($query['pager']); ?>
	</div>
</div>
</div>
<!--/col-->
</div>
<!--/row-->
</div>
</div>

<!-- 頁面內容 -->
</div>
</main>

<? include_once($_env['site_admin_path'].'layout/footer.php'); ?>

<script>
function index_go_page(page){
	$("#index_qry_form").append("<input name='p' value='"+page+"' type='hidden' />")
	.submit();
}

function index_del_data(id){
	var fn = function(){
		sys_set_loading(true);
		$.ajax({
			type: "POST",
			url: "ajax.php",
			data: {
				"fn": "del",
				"id": id
			},
			success:function(result){
				var chk = sys_ajax_not_allow(result.ok);
				if(chk===true){
					sys_show_message(result.msg);
					if(result.ok=='t') $("#tr_"+id).remove();
				}
				sys_set_loading(false);
			},
			error:function(xhr, ajaxOptions, thrownError){
				sys_ajax_error(xhr, ajaxOptions, thrownError);
			},
			datatype:"json"
		});
	}
	sys_confirm_message('確定刪除？', fn, false);
}
</script>