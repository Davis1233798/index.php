<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");

$sql = "SELECT id, title FROM faq_category WHERE inuse = 1 ORDER BY sort, id";
$data_class = $db->doselect($sql);

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
                                <!-- Jack 20220217 修改為代餐管理 -->
                                <a href="index.php">代餐管理</a> - 新增內容
                            </div>
                            <form method="POST" action="save.php?fn=add" enctype="multipart/form-data">
                                <div class="card-block">
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="txt_sort">排序</label>
                                        <div class="col-md-4">
                                            <input type="number" min="0" id="txt_sort" name="txt_sort" class="form-control" placeholder="請輸入排序"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="txt_category_id">組套類型</label>
                                        <div class="col-md-4">
                                            <select id="sel_category_id" name="sel_category_id" class="form-control" size="1">
                                                <? foreach($data_class as $row){ ?>
                                                    <option value="<? echo $row["id"]; ?>" <? echo $data["category_id"]==$row["id"]?"selected":""; ?>><? echo $row["title"]; ?></option>
                                                <? } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="txt_question"><i style="color: red;">* </i>問題內容</label>
                                        <div class="col-md-4">
                                            <textarea id="txt_question" name="txt_question" rows="9" class="form-control" placeholder="請輸入問題內容"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="txt_answer"><i style="color: red;">* </i>問題解答</label>
                                        <div class="col-md-4">
                                            <textarea id="txt_answer" name="txt_answer" rows="9" class="form-control" placeholder="請輸入問題解答"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="rd_inuse">顯示狀態</label>
                                        <div class="col-md-6">
                                            <label class="radio-inline" for="rd_inuse_t">
                                                <input type="radio" id="rd_inuse_t" name="rd_inuse" value="1" checked /> 顯示
                                            </label>
                                            <label class="radio-inline" for="rd_inuse_f">
                                                <input type="radio" id="rd_inuse_f" name="rd_inuse" value="0" /> 隱藏
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" onclick="history.go(-1)" ><i class="fa fa-arrow-left"></i> 回列表</button>
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> 新增</button>
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
    $("#txt_start_date").datepicker().datepicker('setDate', '<? echo date('Y-m-d'); ?>');
    $("#txt_end_date").datepicker().datepicker('setDate', '<? echo date('Y-m-d'); ?>');
</script>