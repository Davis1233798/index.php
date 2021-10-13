<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");

$id = get_get("id");
$para = array(
	"id"=>$id
);

// 取得健檢人資料
$sql = 'SELECT * FROM reservation WHERE id = :id ';
$data =$db->doselect_first($sql, $para);

// 取得 健檢套組/高階檢查
$sql = 'SELECT r.type, p.name 
		FROM reservation_item r 
		INNER JOIN health_package p ON r.item_id = p.id 
		WHERE r.resv_id = :id AND r.type IN (1, 2) ';
$data_item =$db->doselect($sql, $para);
$arr_item1 = array();
$arr_item2 = array();
foreach($data_item AS $row){
	$row['type']=='1'?array_push($arr_item1, $row['name']):array_push($arr_item2, $row['name']);
}

// 取得自費項目
$sql = 'SELECT i.name 
		FROM reservation_item r 
		INNER JOIN self_pay_item i ON r.item_id = i.id 
		WHERE r.resv_id = :id AND r.type = 3 ';
$data_item3 =$db->doselect($sql, $para);
$arr_item3 = array();
foreach($data_item3 AS $row) array_push($arr_item3, $row['name']);

// 取得問卷內容
$sql = 'SELECT * FROM reservation_quest WHERE resv_id = :id ORDER BY id';
$data_quest =$db->doselect($sql, $para);
$arr_quest = array();
foreach($data_quest AS $row){
	switch($row['quest']){
		case '1':
		case '3':
			$arr_quest['2_'.$row['quest']] = $row['ans'];
			break;
		case '2':
		case '4':
		case '5':
			$arr_quest[$row['step'].'_'.$row['quest']] = $row['ans'];
			break;
		default:
			break;
	}
}

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
		<a href="index.php">預約紀錄</a> - 預約內容
	</div>
	<form method="POST" action="save.php?fn=pdf">
		<input type="hidden" name="hdf_id" value="<? echo $id; ?>" />
		<div class="card-block">
		
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">填寫時間：</label>
				<div class="col-md-8">
					<p class="form-control-static"><? echo date('Y/m/d H:i:s', strtotime($data["created"])); ?></p>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">健檢對象：</label>
				<div class="col-md-4">
					<p class="form-control-static"><? echo $_env['id_type'][$data['id_type']]; ?></p>
				</div>
				<label class="col-md-2 form-control-label" for="text-input">聯絡電話(O)：</label>
				<div class="col-md-4">
					<p class="form-control-static"><? echo $data['tel_office']; ?></p>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">姓名：</label>
				<div class="col-md-4">
					<p class="form-control-static"><? echo $data['name']; ?></p>
				</div>
				<label class="col-md-2 form-control-label" for="text-input">聯絡電話(H)：</label>
				<div class="col-md-4">
					<p class="form-control-static"><? echo $data['tel_home']; ?></p>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">性別：</label>
				<div class="col-md-4">
					<p class="form-control-static"><? echo $data['gender']=='1'?'男':'女'; ?></p>
				</div>
				<label class="col-md-2 form-control-label" for="text-input">傳真：</label>
				<div class="col-md-4">
					<p class="form-control-static"><? echo $data['fax']; ?></p>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">身分證/護照：</label>
				<div class="col-md-4">
					<p class="form-control-static"><? echo $data['identity']; ?></p>
				</div>
				<label class="col-md-2 form-control-label" for="text-input">E-mail：</label>
				<div class="col-md-4">
					<p class="form-control-static"><? echo $data['mail']; ?></p>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">生日：</label>
				<div class="col-md-4">
					<p class="form-control-static"><? echo date('Y/m/d', strtotime($data['birthday'])); ?></p>
				</div>
				<label class="col-md-2 form-control-label" for="text-input">寄藥地址：</label>
				<div class="col-md-4">
					<p class="form-control-static"><? echo $data['add_drug']; ?></p>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">希望預約日期：</label>
				<div class="col-md-4">
					<p class="form-control-static"><? echo date('Y/m/d', strtotime($data['resv_date_s'])), ' 到 ', date('Y/m/d', strtotime($data['resv_date_e'])); ?></p>
				</div>
				<label class="col-md-2 form-control-label" for="text-input">寄報告地址：</label>
				<div class="col-md-4">
					<p class="form-control-static"><? echo $data['add_report']; ?></p>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">費用：</label>
				<div class="col-md-10">
					<p class="form-control-static"><? echo $data['price']; ?></p>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">備註：</label>
				<div class="col-md-10">
					<p class="form-control-static"><? echo nl2br($data['memo']); ?></p>
				</div>
			</div>
			
			<div class="card">
				<div class="card-header">
					<div style="cursor: pointer; margin-top: -0.75rem; margin-bottom: -0.75rem; padding-top: 0.75rem; padding-bottom: 0.75rem;margin-right: 50px;" onclick="$('#hl_card1').click();">預約項目</div>
					<div class="card-actions">
						<a id="hl_card1" class="btn-minimize" data-toggle="collapse" href="#card_div1" aria-expanded="true" aria-controls="card_div1"><i class="icon-arrow-down"></i></a>
					</div>
				</div>
				<div class="card-block collapse in" id="card_div1" >
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="txt_div1"><? echo $_env['package_type']['1']; ?>：</label>
						<div class="col-md-10">
							<p class="form-control-static"><? echo implode('、', $arr_item1); ?></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="txt_div1"><? echo $_env['package_type']['2']; ?>：</label>
						<div class="col-md-10">
							<p class="form-control-static"><? echo implode('、', $arr_item2); ?></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="txt_div1">自費項目：</label>
						<div class="col-md-10">
							<p class="form-control-static"><? echo implode('、', $arr_item3); ?></p>
						</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<div style="cursor: pointer; margin-top: -0.75rem; margin-bottom: -0.75rem; padding-top: 0.75rem; padding-bottom: 0.75rem;margin-right: 50px;" onclick="$('#hl_card2').click();">健檢問卷</div>
					<div class="card-actions">
						<a id="hl_card2" class="btn-minimize" data-toggle="collapse" href="#card_div2" aria-expanded="false" aria-controls="card_div2"><i class="icon-arrow-up"></i></a>
					</div>
				</div>
				<div class="card-block collapse" id="card_div2" >
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="txt_div1">懷孕婦女：</label>
						<div class="col-md-10">
							<p class="form-control-static"><? echo $arr_quest['1_2']==''?'未調查':$arr_quest['1_2']; ?></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="txt_div1">是否有心血管疾病個人病史或家族病史：</label>
						<div class="col-md-10">
							<p class="form-control-static"><? echo $arr_quest['1_4']==''?'未調查':$arr_quest['1_4']; ?></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="txt_div1">是否有吸菸：</label>
						<div class="col-md-10">
							<p class="form-control-static"><? echo $arr_quest['1_5']==''?'未調查':$arr_quest['1_5']; ?></p>
						</div>
					</div>
					<hr />
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="txt_div1">過去病史：</label>
						<div class="col-md-10">
							<p class="form-control-static"><? echo $arr_quest['2_1']==''?'無':$arr_quest['2_1']; ?></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="txt_div1">使用抗凝血劑：</label>
						<div class="col-md-10">
							<p class="form-control-static"><? echo $arr_quest['2_2']==''?'無':$arr_quest['2_2']; ?></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="txt_div1">藥物過敏史：</label>
						<div class="col-md-10">
							<p class="form-control-static"><? echo $arr_quest['2_3']==''?'無':$arr_quest['2_3']; ?></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="txt_div1">近三個月內住院原因：</label>
						<div class="col-md-10">
							<p class="form-control-static"><? echo $arr_quest['2_4']==''?'無':$arr_quest['2_4']; ?></p>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="card-footer">
			<button type="button" class="btn btn-sm btn-secondary" onclick="history.go(-1)" ><i class="fa fa-arrow-left"></i> 回列表</button>
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