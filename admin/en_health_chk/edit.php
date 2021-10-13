<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");

$id = get_get("id");
$sql = "SELECT * FROM `en_health_chk` WHERE id = :id";
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
		<a href="index.php">英文健檢管理</a> - 修改內容
	</div>
	<form method="POST" action="save.php?fn=edit" enctype="multipart/form-data">
		<input type="hidden" name="hdf_id" value="<? echo $id; ?>" />
		<input type="hidden" name="hdf_filename" value="<? echo $data["filename"]; ?>" />
		<div class="card-block">
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_sort">排序</label>
				<div class="col-md-4">
					<input type="number" min="0" id="txt_sort" name="txt_sort" class="form-control" placeholder="請輸入排序" value="<? echo $data["sort"]; ?>" />
				</div>
			</div>			
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_category_id">類別</label>
				<div class="col-md-4">
					<select id="sel_category_id" name="sel_category_id" class="form-control" size="1">
						<option value="1" <? echo $data["category_id"]==1?"selected":""; ?>>Screening Items</option>
						<option value="2" <? echo $data["category_id"]==2?"selected":""; ?>>Special examinations</option>
						<option value="3" <? echo $data["category_id"]==3?"selected":""; ?>>Selective advanced imaging studies</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_content"><i style="color: red;">* </i>內容</label>
				<div class="col-md-4">
					<textarea id="txt_content" name="txt_content" rows="9" class="form-control" placeholder="請輸入內容"><? echo $data["content"]; ?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_price">價格</label>
				<div class="col-md-4">
					<input type="text" id="txt_price" name="txt_price" class="form-control" placeholder="請輸入價格" maxlength="50" value="<? echo $data["price"]; ?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="rd_inuse">顯示狀態</label>
				<div class="col-md-6">
					<label class="radio-inline" for="rd_inuse_t">
						<input type="radio" id="rd_inuse_t" name="rd_inuse" value="1" <? echo $data["inuse"]=='1'?"checked":""; ?> /> 顯示
					</label>
					<label class="radio-inline" for="rd_inuse_f">
						<input type="radio" id="rd_inuse_f" name="rd_inuse" value="0" <? echo $data["inuse"]=='0'?"checked":""; ?> /> 隱藏
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
$("#txt_start_date").datepicker();
$("#txt_end_date").datepicker();

</script>


