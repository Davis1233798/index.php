<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");

?>
<body class="navbar-fixed sidebar-nav fixed-nav">
<? include_once($_env["site_admin_path"]."layout/navbar.php"); ?>
<? include_once($_env["site_admin_path"]."layout/sidebar.php"); ?>

<main class="main">
<div class="container-fluid">
<!-- 頁面內容 -->

<?
	$page = get_post("p", 1);
	$qry_date = get_post("txt_date");
	$qry_keyword = get_post("txt_keyword");
	$para = array();
	$order = array("id"=>"d");
	$sql = "SELECT `id`, name, identity, mobile, DATE_FORMAT(`created`, '%Y/%m/%d') AS created 
			FROM `reservation`
			WHERE 1 = 1 ";
	if($qry_date!=''){
		$para["date"] = $qry_date;
		$sql .= 'AND (DATE(:date) BETWEENS DATE(resv_date_s) AND DATE(resv_date_e)
				OR DATE(birthday) = DATE(:date)) ';
	}
	if($qry_keyword!=''){
		$para["keyword"] = '%'.$qry_keyword.'%';
		$sql .= 'AND (name LIKE :keyword 
				OR identity LIKE :keyword
				OR add_drug LIKE :keyword
				OR add_report LIKE :keyword
				OR tel_home LIKE :keyword
				OR tel_office LIKE :keyword
				OR mobile LIKE :keyword
				OR fax LIKE :keyword
				OR mail LIKE :keyword
				OR memo LIKE :keyword) ';
	}
	$query = $db->doselect_page($sql, $para, $order, $page);
	
?>
<div class="container-fluid">
<div class="animated fadeIn">
<div class="row row-equal">
<div class="row">
<div class="col-lg-12">
<div class="card">
	<div class="card-header">
		預約紀錄列表
	</div>
	<div class="card-block">
	
		<div class="card-block">
			<form id="index_qry_form" method="POST">
				<div class="col-md-8">
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="text-input">日期</label>
						<div class="col-md-6">
							<input type="text" id="txt_date" name="txt_date" class="form-control" value="<? echo $qry_date; ?>" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for="text-input">關鍵字搜尋</label>
						<div class="col-md-8">
							<input type="text" id="txt_keyword" name="txt_keyword" class="form-control" value="<? echo $qry_keyword; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group row">
						<button type="submit" class="btn btn-sm btn-secondary"><i class="fa fa-search"></i> 查詢</button>
					</div>
				</div>
			</form>
		</div>
		<form id="index_pdf_form" method="POST" action="./save.php?fn=multi_pdf">
		<table class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th>填寫日期</th>
					<th>姓名</th>
					<th>身分證字號</th>
					<th>手機</th>
					<th width="20%"></th>
				</tr>
			</thead>
			<tbody>
				<? foreach($query["data"] as $row){ ?>
					<tr id="tr_<? echo $row["id"] ?>">
						<td><? echo $row['created'] ?></td>
						<td><? echo $row['name'] ?></td>
						<td><? echo $row['identity'] ?></td>
						<td><? echo $row['mobile'] ?></td>
						<td>
							<button type="button" class="btn btn-primary" onclick="javascript:location.href='edit.php?id=<? echo $row["id"] ?>'">檢視</button>
						</td>
					</tr>
				<? } ?>
			</tbody>
		</table>
		</form>
		<? create_pager($query["pager"]); ?>
	</div>
</div>
</div>
<!--/col-->
</div>
<!--/row-->
</div>
</div>

<!-- 頁面內容 -->
</div>
</main>

<? include_once($_env["site_admin_path"]."layout/footer.php"); ?>

<script>
$("#txt_date").datepicker();

function index_go_page(page){
	$("#index_qry_form").append("<input name='p' value='"+page+"' type='hidden' />")
	.submit();
}
</script>