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
	$sql = 'SELECT id, `name` FROM self_pay_item_class ORDER BY sort';
	$query = $db->doselect($sql);
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
	
		<table class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th>健檢類別名稱</th>
					<th width="20%"></th>
				</tr>
			</thead>
			<tbody id="tb_body">
				<? foreach($query as $row){ ?>
					<tr id="tr_<? echo $row["id"] ?>" data-id="<? echo $row["id"] ?>">
						<td><? echo $row["name"] ?></td>
						<td>
							<button type="button" class="btn btn-primary" onclick="javascript:location.href='edit.php?id=<? echo $row["id"] ?>'">編輯</button>
						</td>
					</tr>
				<? } ?>
			</tbody>
		</table>
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
</script>