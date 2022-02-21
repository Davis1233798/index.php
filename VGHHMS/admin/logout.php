<?
	include_once(dirname(__DIR__).'/include/adminclass.php');
	include_once(__DIR__.'/layout/header.php');
	
	do_logout();
?>

<? include_once(__DIR__.'/layout/footer.php'); ?>
<script>sys_show_message("您已經登出", "<? echo $_env['site_admin_url']; ?>index.php", true);</script>