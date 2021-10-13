<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");

$sql = "SELECT id, title FROM news_img ORDER BY sort, id";
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
		<a href="index.php">最新消息內容管理</a> - 新增內容
	</div>
	<form method="POST" action="save.php?fn=add" enctype="multipart/form-data">
		<div class="card-block">
		
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_start_date"><i style="color: red;">* </i>上架日期</label>
				<div class="col-md-4">
					<input type="text" id="txt_start_date" name="txt_start_date" class="form-control" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_end_date">下架日期</label>
				<div class="col-md-4">
					<input type="text" id="txt_end_date" name="txt_end_date" class="form-control" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_title"><i style="color: red;">* </i>標題</label>
				<div class="col-md-4">
					<input type="text" id="txt_title" name="txt_title" class="form-control" placeholder="請輸入標題" maxlength="200" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_en_title">英文標題</label>
				<div class="col-md-4">
					<input type="text" id="txt_en_title" name="txt_en_title" class="form-control" placeholder="請輸入英文標題" maxlength="200" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="rd_inuse">顯示狀態</label>
				<div class="col-md-6">
					<label class="radio-inline" for="rd_inuse_t">
						<input type="radio" id="rd_inuse_t" name="rd_inuse" value="1" checked /> 顯示
					</label>
					<label class="radio-inline" for="rd_inuse_f">
						<input type="radio" id="rd_inuse_f" name="rd_inuse" value="0" /> 隱藏
					</label>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_default">預設列表圖<br>(若選擇預設圖則不須上傳列表圖)</label>
				<div class="col-md-4">
					<select id="sel_default" name="sel_default" class="form-control" size="1">
						<option value="0" <? echo $data["default_img"]==$row["id"]?"selected":""; ?>>請選擇</option>
						<? foreach($data_class as $row){ ?>
							<option value="<? echo $row["id"]; ?>" <? echo $data["default_img"]==$row["id"]?"selected":""; ?>><? echo $row["title"]; ?></option>
						<? } ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_filename">列表圖</label>
				<div class="col-md-6">
					<input type="file" id="f_filename" name="f_filename" class="form-control" />
					<span class="help-block">建議尺寸：<? echo $_pageenv["filename_size"]; ?></span>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="f_img">內頁圖</label>
				<div class="col-md-6">
					<input type="file" id="f_img" name="f_img" class="form-control" />
					<span class="help-block">建議尺寸：<? echo $_pageenv["img_size"]; ?></span>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_content">內容</label>
				<div class="col-md-10">
					<textarea id="txt_content" name="txt_content" rows="9" class="form-control" placeholder="請輸入內容"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_en_content">英文內容</label>
				<div class="col-md-10">
					<textarea id="txt_en_content" name="txt_en_content" rows="9" class="form-control" placeholder="請輸入英文內容"></textarea>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="button" class="btn btn-sm btn-secondary" onclick="history.go(-1)" ><i class="fa fa-arrow-left"></i> 回列表</button>
			<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> 新增</button>
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
$("#txt_start_date").datepicker().datepicker('setDate', '<? echo date('Y-m-d'); ?>');
$("#txt_end_date").datepicker();
</script>