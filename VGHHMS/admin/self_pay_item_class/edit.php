<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");

$id = get_get("id");
$sql = "SELECT * FROM self_pay_item_class WHERE id = :id";
$data = $db->doselect_first($sql, array("id"=>$id));

?>
<body class="navbar-fixed sidebar-nav fixed-nav">
<? include_once($_env["site_admin_path"]."layout/navbar.php"); ?>
<? include_once($_env["site_admin_path"]."layout/sidebar.php"); ?>

<main class="main">
<div class="container-fluid">
<!-- 頁面內容 -->

<div class="container-fluid">
<div class="row row-equal">
<div class="row">
<div class="col-lg-12">
<div class="card">
	<div class="card-header">
		<a href="index.php"><? echo $_pageenv["fn_name"]; ?></a> - <? echo $_pageenv["fn_name_edit"]; ?>
	</div>
	<form method="POST" action="save.php?fn=edit" enctype="multipart/form-data">
		<input type="hidden" name="hdf_id" value="<? echo $id; ?>" />
		<div class="card-block">

			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_name"><i style="color: red;">* </i>健檢類別名稱</label>
				<div class="col-md-4">
					<input type="text" id="txt_name" name="txt_name" class="form-control" placeholder="請輸入健檢類別名稱" maxlength="20" value="<? echo $data["name"]; ?>" />
				</div>
			</div>
			
		</div>
		<div class="card-footer">
			<button type="button" class="btn btn-sm btn-secondary" onclick="history.go(-1)" ><i class="fa fa-arrow-left"></i> 回列表</button>
			<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> 儲存</button>
			<button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-history"></i> 重填</button>
		</div>
	</form>
</div>
</div>
<!--/col-->
</div>
<!--/row-->
</div>


<!-- 頁面內容 -->
</div>
</main>

<? include_once($_env["site_admin_path"]."layout/footer.php"); ?>
<script>

//修改類別
$("#sel_class").change(function(){
	if($(this).val()=='1') $('#div_show_detail').fadeOut('medium');
	else $('#div_show_detail').fadeIn('medium');
});

// 拖曳改輪播圖排序
$('#div_img_sort').sortable({
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
					"fn": "img_sort",
					"id": id,
					"case_id": <? echo $id; ?>,
					"sort_diff": sort_diff,
				},
				success:function(result){
					var chk = sys_ajax_not_allow(result.ok);
					sys_set_loading(false);
				},
				error:function(xhr, ajaxOptions, thrownError){
					$("#div_img_sort").sortable("cancel");
					sys_ajax_error(xhr, ajaxOptions, thrownError);
				},
				datatype:"json"
			});
		}
		var r = sys_confirm_message('確定修改排序？', fn, false);
		if(r===false) $("#div_img_sort").sortable("cancel");
	},
});

// 刪除輪播圖
function del_img(id){
	var fn = function(){
		sys_set_loading(true);
		$.ajax({
			type: "POST",
			url: "ajax.php",
			data: {
				"fn": "del_img",
				"id": id
			},
			success:function(result){
				var chk = sys_ajax_not_allow(result.ok);
				if(chk===true){
					sys_show_message(result.msg);
					if(result.ok=='t') $("#div_img_"+id).remove();
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


