<?
	$_baseenv['page_type'] = 'login';
	include_once(dirname(__DIR__).'/include/adminclass.php');
	include_once($_env['site_admin_path'].'layout/header.php');
    session_start();
	$acc = ($_COOKIE[$_env['site_code'].'_loginpage_acc']?$_COOKIE[$_env['site_code'].'_loginpage_acc']:'');
	$psd = ($_COOKIE[$_env['site_code'].'_loginpage_psd']?$_COOKIE[$_env['site_code'].'_loginpage_psd']:'');
?>
<body>
<div class="container">
<div class="row">
<div class="col-md-6 col-md-offset-3">
<div class="card-group vamiddle">
<div class="card  p-a-2">
<div class="card-block">

	<h3>登入</h3>
	<p></p>
	<div class="input-group m-b-1">
		<span class="input-group-addon"><i class="icon-user"></i></span>
		<input id="txt_acc" type="text" class="form-control" placeholder="請輸入帳號" value="<? echo $acc; ?>">
	</div>
	<div class="input-group m-b-2">
		<span class="input-group-addon"><i class="icon-lock"></i></span>
		<input id="txt_psd" type="password" class="form-control" placeholder="請輸入密碼" value="<? echo $psd; ?>">
	</div>
	<div class="input-group m-b-2">
		<span class="input-group-addon"><i class="icon-lock"></i></span>
		<input id="txt_confirm" type="text" class="form-control" placeholder="請輸入驗證碼" maxlength="4">
	</div>
	<div class="input-group m-b-2">
		<img id="img_confirm" src="<? echo $_env["site_url"]; ?>include/confirmcode.php?p=admin_login" />
	</div>
	<div class="input-group m-b-2">
		<div class="checkbox">
			<label>
				<input type="checkbox" id="chk_remember" name="chk_remember" <? echo ($acc!=''&&$psd!='')?'checked':''; ?> /> 記住帳密
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6">
			<button type="button" class="btn btn-primary p-x-2" onclick="do_login()">登入</button>
		</div>
	</div>

</div>
</div>
</div>
</div>
</div>
</div>

<? include_once(__DIR__.'/layout/footer.php'); ?>

<script>
function verticalAlignMiddle(){
	var bodyHeight = $(window).height();
	var formHeight = $('.vamiddle').height();
	var marginTop = (bodyHeight / 2) - (formHeight / 2);
	if (marginTop > 0){
		$('.vamiddle').css('margin-top', marginTop);
	}
}

$(document).ready(function(){
	verticalAlignMiddle();
});

$(window).bind('resize', verticalAlignMiddle);

$("#txt_acc").keydown(function(event){
	if($(this).val()!=""&&event.which==13){
		$("#txt_psd").focus();
	}
});

$("#txt_psd").keydown(function(event){
	if( event.which==13) {
		$("#txt_confirm").focus();
	}
});

$("#txt_confirm").keydown(function(event){
	if( event.which==13) {
		do_login();
	}
});

function do_login(){
	sys_set_loading(true);
	$.ajax({
		type: "POST",
		url: "main/login.php",
		data: {
			"acc": $("#txt_acc").val(),
			"psd": $("#txt_psd").val(),
			"confirm": $("#txt_confirm").val(),
			"remember": $('#chk_remember').prop('checked')===true?'1':'0',
		},
		success:function(result){
			if(result.ok=='t'){
				sys_show_message("登入成功", "<? echo $_env['site_admin_url']; ?>home.php", true);
			} else {
				$('#txt_confirm').val('');
				$('#img_confirm').attr('src', '<? echo $_env["site_url"]; ?>include/confirmcode.php?p=admin_login');
				sys_show_message(result.msg);
			}
			sys_set_loading(false);
		},
		error:function(xhr, ajaxOptions, thrownError){
			sys_ajax_error(xhr, ajaxOptions, thrownError);
		},
		datatype:"json"
	});
}

$("#txt_<? echo ($acc!=''&&$psd!='')?'confirm':'acc'; ?>").focus();
</script>

