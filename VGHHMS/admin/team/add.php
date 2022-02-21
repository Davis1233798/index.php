<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");

$sql = "SELECT id, title, en_title FROM team_category WHERE inuse = 1 ORDER BY sort, id";
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
		<a href="index.php">團隊成員管理</a> - 新增內容
	</div>
	<form method="POST" action="save.php?fn=add" enctype="multipart/form-data">
		<div class="card-block">
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_sort">排序</label>
				<div class="col-md-4">
					<input type="number" min="0" id="txt_sort" name="txt_sort" class="form-control" placeholder="請輸入排序"/>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_filename">大頭照</label>
				<div class="col-md-6">
					<input type="file" id="f_filename" name="f_filename" class="form-control" />
					<span class="help-block">建議尺寸：<? echo $_pageenv["filename_size"]; ?></span>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_name"><i style="color: red;">* </i>姓名</label>
				<div class="col-md-4">
					<input type="text" id="txt_name" name="txt_name" class="form-control" placeholder="請輸入姓名" maxlength="50" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_en_name">name</label>
				<div class="col-md-4">
					<input type="text" id="txt_en_name" name="txt_en_name" class="form-control" placeholder="name" maxlength="50" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_gender">性別</label>
				<div class="col-md-4">
					<select id="sel_gender" name="sel_gender" class="form-control" size="1">
						<option value="3" <? echo $data["gender"]==3?"selected":""; ?>></option>
						<option value="1" <? echo $data["gender"]==1?"selected":""; ?>>男</option>
						<option value="2" <? echo $data["gender"]==2?"selected":""; ?>>女</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_category_id">類別</label>
				<div class="col-md-4">
					<select id="sel_category_id" name="sel_category_id" class="form-control" size="1">
						<? foreach($data_class as $row){ ?>
							<option value="<? echo $row["id"]; ?>" <? echo $data["category_id"]==$row["id"]?"selected":""; ?>><? echo $row["title"]; ?></option>
						<? } ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_category_en">英文類別</label>
				<div class="col-md-4">
					<select id="sel_category_en" name="sel_category_en" class="form-control" size="1">
						<option value="0" <? echo $data["category_en"]==0?"selected":""; ?>>不顯示</option>
						<? foreach($data_class as $row){ ?>
							<option value="<? echo $row["id"]; ?>" <? echo $data["category_en"]==$row["id"]?"selected":""; ?>><? echo $row["en_title"]; ?></option>
						<? } ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_division"><i style="color: red;">* </i>科別</label>
				<div class="col-md-4">
					<input type="text" id="txt_division" name="txt_division" class="form-control" placeholder="請輸入科別" maxlength="100" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_en_division">department/divisio</label>
				<div class="col-md-4">
					<input type="text" id="txt_en_division" name="txt_en_division" class="form-control" placeholder="department/divisio" maxlength="100" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_url">外部連結網址</label>
				<div class="col-md-4">
					<input type="text" id="txt_url" name="txt_url" class="form-control" placeholder="若填寫外部連結便不必填寫下方各項，將直接外連至網址位置" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_edu">學歷</label>
				<div class="col-md-4">
					<textarea id="txt_edu" name="txt_edu" rows="9" class="form-control" placeholder="請輸入學歷"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_en_edu">Education</label>
				<div class="col-md-4">
					<textarea id="txt_en_edu" name="txt_en_edu" rows="9" class="form-control" placeholder="Education"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_exp">經歷</label>
				<div class="col-md-4">
					<textarea id="txt_exp" name="txt_exp" rows="9" class="form-control" placeholder="請輸入經歷"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_en_exp">Professional experience</label>
				<div class="col-md-4">
					<textarea id="txt_en_exp" name="txt_en_exp" rows="9" class="form-control" placeholder="Professional experience"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_spec">專長</label>
				<div class="col-md-4">
					<textarea id="txt_spec" name="txt_spec" rows="9" class="form-control" placeholder="請輸入專長"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_en_spec">Specialty</label>
				<div class="col-md-4">
					<textarea id="txt_en_spec" name="txt_en_spec" rows="9" class="form-control" placeholder="Specialty"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_job">現職</label>
				<div class="col-md-4">
					<textarea id="txt_job" name="txt_job" rows="9" class="form-control" placeholder="請輸入現職"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_en_job">current position</label>
				<div class="col-md-4">
					<textarea id="txt_en_job" name="txt_en_job" rows="9" class="form-control" placeholder="current position"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_license">證照</label>
				<div class="col-md-4">
					<textarea id="txt_license" name="txt_license" rows="9" class="form-control" placeholder="請輸入證照"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_en_license">Medical licenses</label>
				<div class="col-md-4">
					<textarea id="txt_en_license" name="txt_en_license" rows="9" class="form-control" placeholder="Medical licenses"></textarea>
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
$("#txt_end_date").datepicker().datepicker('setDate', '<? echo date('Y-m-d'); ?>');
</script>