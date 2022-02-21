<?
$_baseenv['page_type'] = 'page';
include_once(__DIR__.'/local_parameter.php');
include_once(dirname(dirname(__DIR__)).'/include/adminclass.php');
include_once($_env['site_admin_path'].'layout/header.php');

$sql = 'select * from sys_config';
$data = $db->doselect_first($sql);

?>
<link rel="stylesheet" href="<? echo $_env['site_admin_url'] ?>css/bootstrap-tagsinput.css">
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
		<? echo $_pageenv['fn_name']; ?>
	</div>
	<form id="form1" method="POST" action="save.php?fn=edit">
		<div class="card-block">
		
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_site_title">網站名稱</label>
				<div class="col-md-6">
					<input type="text" id="txt_site_title" name="txt_site_title" class="form-control" placeholder="請輸入網站名稱" maxlength="50" value="<? echo $data['site_title']; ?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_keywords">網站關鍵字</label>
				<div class="col-md-10">
					<input type="text" id="txt_keywords" name="txt_keywords" class="form-control" placeholder="請輸入網站關鍵字" value="<? echo $data['keywords']; ?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_mail_receive">預約通知信箱</label>
				<div class="col-md-10">
					<input type="text" id="txt_mail_receive" name="txt_mail_receive" data-role="tagsinput" class="form-control col-md-12" value="<? echo $data['mail_receive']; ?>" />
					<br />
					<span class="help-block">按下 Enter 即可新增項目，請勿包含 '||'</span>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_mail_account">Mail登入帳號</label>
				<div class="col-md-10">
					<input type="text" id="txt_mail_account" name="txt_mail_account" class="form-control" placeholder="請輸入Mail登入帳號" maxlength="30" value="<? echo $data['mail_account']; ?>" />
					<span class="help-block">@以後不用輸入，例：若帳號為myacc@gmail.com，則輸入myacc</span>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_mail_password">Mail登入密碼</label>
				<div class="col-md-10">
					<input type="password" id="txt_mail_password" name="txt_mail_password" class="form-control" placeholder="請輸入Mail登入密碼" maxlength="50" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_mail_sendaddress">Mail發送地址</label>
				<div class="col-md-10">
					<input type="text" id="txt_mail_sendaddress" name="txt_mail_sendaddress" class="form-control" placeholder="請輸入Mail發送地址" maxlength="100" value="<? echo $data['mail_sendaddress']; ?>" />
					<span class="help-block">收信人會看到的發信帳號，請輸入完整Email</span>
				</div>
			</div>
			<?/*
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_keywords">Mail Server加密</label>
				<div class="col-md-6">
					<label class="radio-inline" for="rd_mail_secure_none">
						<input type="radio" id="rd_mail_secure_none" name="rd_mail_secure" value="" <? echo $data['mail_secure']==''?'checked':''; ?> /> 無
					</label>
					<label class="radio-inline" for="rd_mail_auth_ssl">
						<input type="radio" id="rd_mail_auth_ssl" name="rd_mail_secure" value="ssl" <? echo $data['mail_secure']=='ssl'?'checked':''; ?> /> SSL
					</label>
					<label class="radio-inline" for="rd_mail_auth_tls">
						<input type="radio" id="rd_mail_auth_tls" name="rd_mail_secure" value="tls" <? echo $data['mail_secure']=='tls'?'checked':''; ?> /> TLS
					</label>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_mail_host">Mail Server位址</label>
				<div class="col-md-10">
					<input type="text" id="txt_mail_host" name="txt_mail_host" class="form-control" placeholder="請輸入Mail Server位址" maxlength="30" value="<? echo $data['mail_host']; ?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_mail_port">Mail Server 連接埠</label>
				<div class="col-md-10">
					<input type="text" id="txt_mail_port" name="txt_mail_port" class="form-control" placeholder="請輸入Mail Server連接埠" value="<? echo $data['mail_port']; ?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_keywords">Mail發送需驗證帳密</label>
				<div class="col-md-6">
					<label class="radio-inline" for="rd_mail_auth_t">
						<input type="radio" id="rd_mail_auth_t" name="rd_mail_auth" value="1" <? echo $data['mail_auth']=='1'?'checked':''; ?> /> 是
					</label>
					<label class="radio-inline" for="rd_mail_auth_f">
						<input type="radio" id="rd_mail_auth_f" name="rd_mail_auth" value="0" <? echo $data['mail_auth']=='0'?'checked':''; ?> /> 否
					</label>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_mail_sendname">Mail發送人</label>
				<div class="col-md-10">
					<input type="text" id="txt_mail_sendname" name="txt_mail_sendname" class="form-control" placeholder="請輸入Mail發送人" maxlength="50" value="<? echo $data['mail_sendname']; ?>" />
				</div>
			</div>
			*/?>
		</div>
		<div class="card-footer">
			<button type="button" class="btn btn-sm btn-primary" onclick="do_submit()"><i class="fa fa-check"></i> 儲存</button>
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

<? include_once($_env['site_admin_path'].'layout/footer.php'); ?>
<script src="<? echo $_env['site_admin_url']; ?>js/bootstrap-tagsinput.js"></script>
<script>

function do_submit(){
	write_tags_input("txt_mail_receive");
	$("#form1").submit();
}

// 將tagsinput值修改為用||分隔
function write_tags_input(ipt_id){
	var item = $('#'+ipt_id).tagsinput('items');
	var val = "";
	if(item.length>0){
		$.each(item, function(k, v){
			if(val=="") val+= v;
			else val+= "||"+v;
		});
	}
	$('#'+ipt_id).val(val);
}
</script>