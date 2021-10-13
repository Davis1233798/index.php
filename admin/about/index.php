<?
$_baseenv['page_type'] = 'page';
include_once(__DIR__.'/local_parameter.php');
include_once(dirname(dirname(__DIR__)).'/include/adminclass.php');
include_once($_env['site_admin_path'].'layout/header.php');

$sql = 'select * from about';
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
	<form id="form1" method="POST" action="save.php?fn=edit" enctype="multipart/form-data">
		<div class="card-block">			
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="txt_filename">醫師大合照</label>
				<div class="col-md-6">
					<input type="file" id="f_filename" name="f_filename" class="form-control" />
					<span class="help-block">建議尺寸：<? echo $_pageenv["filename_size"]; ?></span>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input"></label>
				<div class="col-md-6">
					<img src="<? echo $_env["site_url"]."images/".$_pageenv["filename_tnfile"].".png"; ?>" style="background-image:url('<? echo $_env["site_upload_url"]."about/".$data["filename"];?>');background-repeat:no-repeat;background-size:contain;background-position : 50% 50%" />
				</div>
			</div>
		</div>
		<div class="card-footer">
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

<? include_once($_env['site_admin_path'].'layout/footer.php'); ?>