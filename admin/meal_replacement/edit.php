<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");

$id = get_get("id");
$sql = "SELECT * FROM health_package WHERE id = :id";
$data = $db->doselect_first($sql, array("id"=>$id));

$sql = "SELECT id, name FROM health_package_class ORDER BY sort, id";
$data_class = $db->doselect($sql);

// 取得流程項目
$sql = "SELECT lv1.id AS lv1_id, lv1.name AS lv1_name, f1.inuse AS lv1_inuse, IFNULL(lv2.id, '') AS lv2_id, lv2.name AS lv2_name, f2.inuse AS lv2_inuse, IFNULL(lv3.id, '') AS lv3_id, lv3.name AS lv3_name, f3.inuse AS lv3_inuse
		FROM health_package_flow lv1 
		LEFT JOIN health_package_with_flow f1 ON f1.f_id = lv1.id AND f1.p_id = :id
		LEFT JOIN health_package_flow lv2 ON lv1.id = lv2.p_id 
		LEFT JOIN health_package_with_flow f2 ON f2.f_id = lv2.id AND f2.p_id = :id
		LEFT JOIN health_package_flow lv3 ON lv2.id = lv3.p_id 
		LEFT JOIN health_package_with_flow f3 ON f3.f_id = lv3.id AND f3.p_id = :id
		WHERE lv1. p_id = 0 
		ORDER BY lv1.sort, lv2.sort, lv3.sort";
$data_flow_item = $db->doselect($sql, array("id"=>$id));

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
		<input type="hidden" name="hdf_pdfname" value="<? echo $data["pdfname"]; ?>" />
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
				<label class="col-md-2 form-control-label" for="txt_name"><i style="color: red;">* </i>組套名稱</label>
				<div class="col-md-4">
					<input type="text" id="txt_name" name="txt_name" class="form-control" placeholder="請輸入組套名稱" maxlength="100" value="<? echo $data["name"]; ?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_workday"><i style="color: red;">* </i>執行日期</label>
				<div class="col-md-4">
					<input type="text" id="txt_workday" name="txt_workday" class="form-control" placeholder="請輸入執行日期" maxlength="20" value="<? echo $data["workday"]; ?>" />
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
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="rd_inuse">流程說明</label>
				<div class="col-md-6">
					<label class="radio-inline" for="rd_show_flow_t">
						<input type="radio" id="rd_show_flow_t" name="rd_show_flow" value="1" <? echo $data["show_flow"]=='1'?"checked":""; ?> /> <? echo $_pageenv["flow_t"]; ?>
					</label>
					<label class="radio-inline" for="rd_show_flow_f">
						<input type="radio" id="rd_show_flow_f" name="rd_show_flow" value="0" <? echo $data["show_flow"]=='0'?"checked":""; ?> /> <? echo $_pageenv["flow_f"]; ?>
					</label>
				</div>
			</div>
			
			<div class="card">
				<div class="card-header">
					<div style="cursor: pointer; margin-top: -0.75rem; margin-bottom: -0.75rem; padding-top: 0.75rem; padding-bottom: 0.75rem;margin-right: 50px;" onclick="$('#hl_card').click();">流程說明</div>
					<div class="card-actions">
						<a id="hl_card" class="btn-minimize collapsed" data-toggle="collapse" href="<? echo $data["show_flow"]=='1'?'#card_flow':''; ?>" aria-expanded="false" aria-controls="card_flow"><i class="icon-arrow-up"></i></a>
					</div>
				</div>
				<div class="card-block collapse" id="card_flow" >
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="txt_acc">細目PDF上傳</label>
						<div class="col-md-6">
							<input type="file" id="f_pdfname" name="f_pdfname" class="form-control" />
							<span class="help-block"><? echo $_pageenv["pdf_hint"]; ?></span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="text-input"></label>
						<div class="col-md-6">
							<a target="_blank" href="<? echo $_env["site_upload_url"]."renewalcase/".$data["pdfname"]; ?>"><? echo $data["pdfname"]; ?></a>
						</div>
					</div>
					<?
						$item_max = count($data_flow_item);
						$arr_lv = array();
						for($i=0;$i<$item_max;$i++){
							$row = $data_flow_item[$i];
							echo '<div class="form-group row">';
							if(!in_array($row['lv1_id'], $arr_lv)){
								array_push($arr_lv, $row['lv1_id']);
				?>
								<label class="col-md-2 form-control-label" for="txt_intro1"><? echo $row['lv1_name']; ?></label>
								<div class="col-md-2">
									<label class="radio-inline" for="rd_flow_t">
										<input type="radio" id="rd_flow_t" name="rd_show_flow_<? echo $row['lv1_id']; ?>" value="1" <? echo $row['lv1_inuse']=='1'?"checked":""; ?> /> <? echo $_pageenv["flow_t"]; ?>
									</label>
									<label class="radio-inline" for="rd_flow_f">
										<input type="radio" id="rd_flow_f" name="rd_show_flow_<? echo $row['lv1_id']; ?>" value="0" <? echo $row['lv1_inuse']=='0'?"checked":""; ?> /> <? echo $_pageenv["flow_f"]; ?>
									</label>
								</div>
				<?
							} else {
								echo '<div class="col-md-4"></div>';
							}

							if($row['lv2_id']!=''&&!in_array($row['lv2_id'], $arr_lv)){
								array_push($arr_lv, $row['lv2_id']);
				?>
								<label class="col-md-2 form-control-label" for="txt_intro1"><? echo $row['lv2_name']; ?></label>
								<div class="col-md-2">
									<label class="radio-inline" for="rd_flow_t">
										<input type="radio" id="rd_flow_t" name="rd_show_flow_<? echo $row['lv2_id']; ?>" value="1" <? echo $row['lv2_inuse']=='1'?"checked":""; ?> /> <? echo $_pageenv["flow_t"]; ?>
									</label>
									<label class="radio-inline" for="rd_flow_f">
										<input type="radio" id="rd_flow_f" name="rd_show_flow_<? echo $row['lv2_id']; ?>" value="0" <? echo $row['lv2_inuse']=='0'?"checked":""; ?> /> <? echo $_pageenv["flow_f"]; ?>
									</label>
								</div>
				<?
							} else {
								echo '<div class="col-md-4"></div>';
							}

							if($row['lv3_id']!=''){
				?>
								<label class="col-md-2 form-control-label" for="txt_intro1"><? echo $row['lv3_name']; ?></label>
								<div class="col-md-2">
									<label class="radio-inline" for="rd_flow_t">
										<input type="radio" id="rd_flow_t" name="rd_show_flow_<? echo $row['lv3_id']; ?>" value="1" <? echo $row['lv3_inuse']=='1'?"checked":""; ?> /> <? echo $_pageenv["flow_t"]; ?>
									</label>
									<label class="radio-inline" for="rd_flow_f">
										<input type="radio" id="rd_flow_f" name="rd_show_flow_<? echo $row['lv3_id']; ?>" value="0" <? echo $row['lv3_inuse']=='0'?"checked":""; ?> /> <? echo $_pageenv["flow_f"]; ?>
									</label>
								</div>
				<?
							} else {
								echo '<div class="col-md-4"></div>';
							}
							echo '</div>';
						}
					?>
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


