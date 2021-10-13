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
	$para = array();
	$order = array("sort"=>"a", "id"=>"a");
	$sql = "SELECT id, filename, sort, inuse FROM banner ";
	$query = $db->doselect_page($sql, $para, $order, $page);
	
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
			</form>
		</div>
		<div class="card-block">
			<div class="col-md-4">
				<div class="form-group row">
					<button type="button" class="btn btn-sm btn-success" onclick="location.href='add.php'"><i class="fa fa-plus"></i> 新增</button>
				</div>
			</div>
		</div>
		<table class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th>輪播圖</th>
					<th width="10%">顯示狀態</th>
					<th width="20%"></th>
				</tr>
			</thead>
			<tbody id="tb_body">
				<? foreach($query["data"] as $row){ ?>
					<tr id="tr_<? echo $row["id"] ?>" data-id="<? echo $row["id"] ?>">
						<td>
							<img src="<? echo $_env["site_url"]."images/".$_pageenv["filename_tnfile"].".png"; ?>" style="background-image:url('<? echo $_env["site_upload_url"]."banner/".$row["filename"];?>');background-repeat:no-repeat;background-size:contain;background-position : 50% 50%" />
						</td>
						<td>
							<? if($row["inuse"]=="1"){ ?><span class="label label-success">顯示</span><? } ?>
							<? if($row["inuse"]=="0"){ ?><span class="label label-default">隱藏</span><? } ?>
						</td>
						<td>
							<button type="button" class="btn btn-primary" onclick="javascript:location.href='edit.php?id=<? echo $row["id"] ?>'">編輯</button>
							<button type="button" class="btn btn-danger" onclick="index_del_data(<? echo $row["id"] ?>)">刪除</button>
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