<div id="sys_div_loading" style="z-index: 99999; width: 100%; height: 100%; top: 0px; left: 0px; position: absolute; background-color: #666; display: none;"></div>
</body>
</html>
<!-- Bootstrap and necessary plugins -->


<script src="<? echo $_env['site_admin_url']; ?>assets/js/libs/jquery.min.js"></script>
<script src="<? echo $_env['site_admin_url']; ?>js/jquery-ui.js"></script>

<?php /*    
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
*/ ?>


<script src="<? echo $_env['site_admin_url']; ?>assets/js/libs/tether.min.js"></script>
<script src="<? echo $_env['site_admin_url']; ?>assets/js/libs/bootstrap.min.js"></script>
<script src="<? echo $_env['site_admin_url']; ?>assets/js/libs/pace.min.js"></script>
<script src="<? echo $_env['site_admin_url']; ?>assets/js/libs/Chart.min.js"></script>
<script src="<? echo $_env['site_admin_url']; ?>assets/js/views/shared.js"></script>
<script src="<? echo $_env['site_admin_url']; ?>assets/js/app.js"></script>
<script src="<? echo $_env['site_admin_url']; ?>js/spin.js"></script>
<script src="<? echo $_env['site_admin_url']; ?>js/datepicker-zh-TW.js"></script>
<script src="<? echo $_env['site_admin_url']; ?>ckeditor/ckeditor.js"></script>
<script>
	
$.datepicker.setDefaults({
    dateFormat: 'yy-mm-dd'
});

// 載入等待畫面
var sys_spinner;
function sys_set_loading(type){
	if(type) {
		$("#sys_div_loading").height($(document).height())
		.fadeTo("100", "0.3", function(){
			var opts = {
				lines: 10, // The number of lines to draw
				length: 10, // The length of each line
				width: 6, // The line thickness
				radius: 15, // The radius of the inner circle
				corners: 1, // Corner roundness (0..1)
				rotate: 10, // The rotation offset
				direction: 1, // 1: clockwise, -1: counterclockwise
				color: '#70cdd2', // #rgb or #rrggbb or array of colors
				speed: 0.9, // Rounds per second
				trail: 48, // Afterglow percentage
				shadow: true, // Whether to render a shadow
				hwaccel: true, // Whether to use hardware acceleration
				className: 'spinner', // The CSS class to assign to the spinner
				zIndex: 2e9, // The z-index (defaults to 2000000000)
				top: '50%', // Top position relative to parent in px
				left: '50%' // Left position relative to parent in px
			};
			sys_spinner = new Spinner(opts).spin($("body")[0]);
		});
	} else if(!type) {
		$("#sys_div_loading").fadeTo("100", "0", function(){ sys_spinner.stop(); }).hide();
	}
}

// ajax錯誤
function sys_ajax_error(xhr, ajaxOptions, thrownError){
	sys_set_loading(false);
	sys_show_message('頁面發生錯誤，請稍後再試');
	console.log(xhr);
	console.log(thrownError);
}

// ajax回傳未登入
function sys_ajax_not_allow(sys_code){
	switch(sys_code){
		case 'l':// 未登入
			location.replace("<? echo $_env['site_admin_url']; ?>logout.php");
			return false;
		case 'a':// 沒有功能權限
			sys_show_message('您沒有操作此功能的權限', script='<? echo $_env['site_admin_url']; ?>home.php', true);
			return false;
		default:
			return true;
	}
}

// 顯示訊息
function sys_show_message(msg, script, isurl){
	alert(msg);
	if(script!=""){
		if(isurl===true) location.replace(script);
	}
}

// 顯示確認訊息
function sys_confirm_message(msg, script, isurl){
	var r = confirm(msg);
	if(r===true){
		if(script!=""){
			if(isurl===true) location.replace(script);
			else script();
		}
	}
}

// 顯示訊息後回上一頁
function sys_back_message(msg){
	alert(msg);
	history.go(-1);
}
</script>