<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");

$id = get_get("id");
$sql = "SELECT * FROM self_pay_item WHERE id = :id";
$data = $db->doselect_first($sql, array("id"=>$id));

$sql = "SELECT id, name FROM self_pay_item_class ORDER BY sort, id";
$data_class = $db->doselect($sql);

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
		<input type="hidden" name="hdf_class_id" value="<? echo $data['class_id']; ?>" />
		<div class="card-block">
		
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="sel_class">類別</label>
				<div class="col-md-4">
					<select id="sel_class" name="sel_class" class="form-control" size="1">
						<? foreach($data_class as $row){ ?>
							<option value="<? echo $row["id"]; ?>" <? echo $data["class_id"]==$row["id"]?"selected":""; ?>><? echo $row["name"]; ?></option>
						<? } ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_name"><i style="color: red;">* </i>項目名稱</label>
				<div class="col-md-4">
					<input type="text" id="txt_name" name="txt_name" class="form-control" placeholder="請輸入套組名稱" maxlength="100" value="<? echo $data["name"]; ?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_price"><i style="color: red;">* </i>費用</label>
				<div class="col-md-4">
					<input type="text" id="txt_price" name="txt_price" class="form-control" placeholder="請輸入費用" maxlength="11" value="<? echo $data["price"]; ?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="rd_inuse">是否啟用</label>
				<div class="col-md-6">
					<label class="radio-inline" for="rd_inuse_t">
						<input type="radio" id="rd_inuse_t" name="rd_inuse" value="1" <? echo $data['inuse']=='1'?'checked':''; ?> /> 啟用
					</label>
					<label class="radio-inline" for="rd_inuse_f">
						<input type="radio" id="rd_inuse_f" name="rd_inuse" value="0" <? echo $data['inuse']=='0'?'checked':''; ?> /> 停用
					</label>
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
	// 選擇流程說明 啟用/停用
	$("input[type='radio'][name='rd_show_flow']").change(function(){
		if($(this).val()=='1'){
			$('#hl_card').prop('href', '#card_flow')
			if(!$('#card_flow').hasClass('in')) $('#hl_card').click();
		} else {
			if($('#card_flow').hasClass('in')) $('#hl_card').click();
			$('#hl_card').prop('href', '');
		}
	});
</script>


