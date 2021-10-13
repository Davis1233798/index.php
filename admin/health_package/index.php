<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");

?>
<body class="navbar-fixed sidebar-nav fixed-nav">
<? include_once($_env["site_admin_path"]."layout/navbar.php"); ?>
<? include_once($_env["site_admin_path"]."layout/sidebar.php"); ?>

<main class="main">
<div class="container-fluid">
<!-- 頁面內容 -->

<?
	$page = get_post("p", 1);
	$qry_class = get_post("sel_class", 0);
	$qry_keyword = get_post("txt_keyword");
	$para = array();
	$order = array("c.sort"=>"a", "c.id"=>"a", "p.sort"=>"a", "p.id"=>"a");
	$sql = "SELECT c.type, c.name AS class_name, p.id, p.name, p.workday, p.price, p.inuse 
			FROM health_package p
			INNER JOIN health_package_class c ON p.class_id = c.id 
			WHERE 1 = 1 ";
	if($qry_class!=''&&$qry_class!='0'){
		$para["class_id"] = $qry_class;
		$sql .= "AND p.class_id = :class_id ";
	}
	if($qry_keyword!=''){
		$para["keyword"] = '%'.$qry_keyword.'%';
		$sql .= "AND(c.name LIKE :keyword OR p.name LIKE :keyword) ";
	}
	$query = $db->doselect_page($sql, $para, $order, $page);
	
	$sql = "SELECT id, type, name FROM health_package_class ORDER BY sort, id";
	$data_class = $db->doselect($sql);
?>
<div class="container-fluid">
<div class="animated fadeIn">
<div class="row row-equal">
<div class="row">
<div class="col-lg-12">
<div class="card">
	<div class="card-header">
		<? echo $_pageenv["fn_name"]; ?>
	</div>
	<div class="card-block">
	
	<div class="card-block">
			<form id="index_qry_form" method="POST">
				<div class="col-md-8">
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="text-input">分類</label>
						<div class="col-md-6">					
							<select id="sel_class" name="sel_class" class="form-control" size="1">
								<option value="0">全部</option>
								<? foreach($data_class as $row){ ?>
									<option value="<? echo $row["id"]; ?>" <? echo $qry_class==$row["id"]?"selected":""; ?>><? echo $_env['package_type'][$row["type"]], ' - ', $row["name"]; ?></option>
								<? } ?>
							</select>
						</div>
					</div>
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
					</div>
				</div>
			</form>
		</div>
		<table class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th>類別</th>
					<th>套組名稱</th>
					<th>執行日期</th>
					<th>費用</th>
					<th>啟用狀態</th>
					<th width="20%"></th>
				</tr>
			</thead>
			<tbody id="tb_body">
				<? foreach($query["data"] as $row){ ?>
					<tr id="tr_<? echo $row["id"] ?>" data-id="<? echo $row["id"] ?>">
						<td><? echo $_env['package_type'][$row["type"]], ' - ', $row["class_name"] ?></td>
						<td><? echo $row["name"] ?></td>
						<td><? echo $row["workday"] ?></td>
						<td><? echo $row["price"] ?></td>
						<td>
							<? if($row['inuse']=='1'){ ?><span class="label label-success">啟用</span><? } ?>
							<? if($row['inuse']=='0'){ ?><span class="label label-default">停用</span><? } ?>
						</td>
						<td>
							<button type="button" class="btn btn-primary" onclick="javascript:location.href='edit.php?id=<? echo $row["id"] ?>'">編輯</button>
						</td>
					</tr>
				<? } ?>
			</tbody>
		</table>
		<? create_pager($query["pager"]); ?>
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

<? include_once($_env["site_admin_path"]."layout/footer.php"); ?>

<script>

// 拖曳改排序
$('#tb_body').sortable({
	start: function(event, ui){
		sort_start = parseInt(ui.item.index());
		ui.item.data('index', ui.item.index())
	},
	update: function(event, ui){
		var fn = function(){
			sys_set_loading(true);
			var id = ui.item.data('id');
			var sort_diff = parseInt(ui.item.index()) - parseInt(ui.item.data('index'));
			
			$.ajax({
				type: "POST",
				url: "ajax.php",
				data: {
					"fn": "index_sort",
					"id": id,
					"sort_diff": sort_diff,
				},
				success:function(result){
					var chk = sys_ajax_not_allow(result.ok);
					if(chk&&result.ok!='t'){
						sys_show_message(result.msg);
						$('#tb_body').sortable('cancel');
					}
					sys_set_loading(false);
				},
				error:function(xhr, ajaxOptions, thrownError){
					$("#tb_body").sortable("cancel");
					sys_ajax_error(xhr, ajaxOptions, thrownError);
				},
				datatype:"json"
			});
		}
		var r = sys_confirm_message('確定修改排序？', fn, false);
		if(r===false) $("#tb_body").sortable("cancel");
	},
});

function index_go_page(page){
	$("#index_qry_form").append("<input name='p' value='"+page+"' type='hidden' />")
	.submit();
}
</script>