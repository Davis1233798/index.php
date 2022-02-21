<?
$_baseenv['page_type'] = 'page';
include_once(__DIR__.'/local_parameter.php');
include_once(dirname(dirname(__DIR__)).'/include/adminclass.php');
include_once($_env['site_admin_path'].'layout/header.php');

$id = get_get('id');
$sql = 'select * from sys_manager where id = :id';
$data = $db->doselect_first($sql, array('id'=>$id));

?>
<body class="navbar-fixed sidebar-nav fixed-nav">
<? include_once($_env['site_admin_path'].'layout/navbar.php'); ?>
<? include_once($_env['site_admin_path'].'layout/sidebar.php'); ?>

<main class="main">
<div class="container-fluid">
<!-- 頁面內容 -->

<div class="container-fluid">
<div class="row row-equal">
<div class="row">
<div class="col-lg-12">
<div class="card">
	<div class="card-header">
		<a href="index.php"><? echo $_pageenv['fn_name']; ?></a> - <? echo $_pageenv['fn_name_edit']; ?>
	</div>
	<form method="POST" action="save.php?fn=edit">
		<input type="hidden" name="hdf_id" value="<? echo $id; ?>" />
		<div class="card-block">
		
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">帳號</label>
				<div class="col-md-6">
					<p class="form-control-static"><? echo $data['acc']; ?></p>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_psd">密碼</label>
				<div class="col-md-6">
					<input type="password" id="txt_psd" name="txt_psd" class="form-control" placeholder="請輸入密碼" maxlength="12" <? if($data['id']=='1') echo "readonly"; ?> />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_psd2"></label>
				<div class="col-md-6">
					<input type="password" id="txt_psd2" name="txt_psd2" class="form-control" placeholder="請再次輸入密碼" maxlength="12" <? if($data['id']=='1') echo "readonly"; ?> />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_name">使用者姓名</label>
				<div class="col-md-6">
					<input type="text" id="txt_name" name="txt_name" class="form-control" placeholder="請輸入使用者姓名" maxlength="20" value="<? echo $data['name']; ?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="rd_inuse">是否啟用</label>
				<div class="col-md-6">
					<label class="radio-inline" for="rd_inuse_t">
						<input type="radio" id="rd_inuse_t" name="rd_inuse" value="1" <? echo $data['inuse']=='1'?'checked':''; ?> <? if($data['id']=='1') echo 'disabled'; ?> /> 啟用
					</label>
					<label class="radio-inline" for="rd_inuse_f">
						<input type="radio" id="rd_inuse_f" name="rd_inuse" value="0" <? echo $data['inuse']=='0'?'checked':''; ?> <? if($data['id']=='1') echo 'disabled'; ?> /> 停用
					</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="card col-lg-12">
					<div class="card-header">
						功能權限
						<div class="card-actions">
							<a class="btn-minimize" data-toggle="collapse" href="#card_div" aria-expanded="false" aria-controls="card_div"><i class="icon-arrow-up"></i></a>
						</div>
					</div>
					<div class="card-block collapse" id="card_div" >
						<?
							$data_auth = array();
							if($data['auth']!=''){
								$data_auth = explode('||', substr($data['auth'], 1, -1));
							}
							$data_sidebar = load_sidebar_data();
							$i = 0;
							$_max = count($data_sidebar);
							while($i<$_max){
								$row = $data_sidebar[$i];

								echo '<div class="form-group row">';
								if($row['c_code']==''){
									echo '<label class="radio-inline">';
									echo '<input type="checkbox" name="chk_auth[]" value="', $row['fn_id'], '" ', (in_array($row['fn_id'], $data_auth)?'checked':''), ' ', ($data['id']=='1'?'disabled':''), '/> ', $row['fn_name'];
									echo '</label>';
								} else {
									echo '<label class="radio-inline"><i class="fa fa-bullseye fa-lg"></i> ', $row['fn_name'], '</label>';
									
									echo '<label class="radio-inline">';
									echo '<input type="checkbox" name="chk_auth[]" value="', $row['c_id'], '" ', (in_array($row['c_id'], $data_auth)?'checked':''), ' ', ($data['id']=='1'?'disabled':''), '/> ', $row['c_name'];
									echo '</label>';

									while($data_sidebar[$i+1]['fn_code']==$row['fn_code']&&$data_sidebar[$i+1]['c_code']!=''){
										$i++;
										$row = $data_sidebar[$i];
										echo '<label class="radio-inline">';
										echo '<input type="checkbox" name="chk_auth[]" value="', $row['c_id'], '" ', (in_array($row['c_id'], $data_auth)?'checked':''), ' ', ($data['id']=='1'?'disabled':''), '/> ', $row['c_name'];
										echo '</label>';
									}
								}
								echo '</div>';
								$i++;
							}
						?>
					</div>
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