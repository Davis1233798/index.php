<!DOCTYPE html>
<html lang="ct">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><? echo $_env['site_title']; ?></title>
	<link href="<? echo $_env['site_url'] ?>images/favicon.ico" rel="icon" type="image/x-icon">
	<link href="<? echo $_env['site_admin_url'] ?>assets/css/style.css" rel="stylesheet">
	<link href="<? echo $_env['site_admin_url'] ?>css/jquery-ui.min.css" rel="stylesheet">
	<?
		header("Cache-Control: private");
		header("Cache-Control: max-age=0");
	?>
</head>

