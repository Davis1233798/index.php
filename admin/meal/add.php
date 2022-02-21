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
                                        <label class="col-md-2 form-control-label" for="meal_name">代餐編號</label>
                                        <div class="col-sm-1">
                                            <input type="number" min="0" id="meal_ID" style = "width: 250px;" name="meal_ID" class="form-control" placeholder="請輸入代餐編號"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="meal_name">代餐名稱</label>
                                        <div class="col-md-4">
                                            <input type="text" min="0" id="meal_name"  name="meal_name" class="form-control" placeholder="請輸入代餐名稱"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="price">價格</label>
                                        <div class="col-md-4">
                                            <input type="number" min="0" id="price" name="price" class="form-control" placeholder="請輸入代餐價格"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="vegetarian">葷素</label>
                                        <div class="col-md-6">
                                            <label class="radio-inline" for="vegetarian">
                                                <input type="radio" id="vegetarian_t" name="vegetarian" value="1" checked /> 葷食
                                            </label>
                                            <label class="radio-inline" for="vegetarian_s">
                                                <input type="radio" id="vegetarian_f" name="vegetarian" value="2" /> 素食
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="remark"><i style="color: red;"></i>代餐內容</label>
                                        <div class="col-md-4">
                                            <textarea id="remark" name="remark" rows="9" class="form-control" placeholder="請輸入代餐內容"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="rd_inuse">狀態</label>
                                        <div class="col-md-6">
                                            <label class="radio-inline" for="enable_t">
                                                <input type="radio" id="enable_t" name="enable" value="1" checked /> 啟用
                                            </label>
                                            <label class="radio-inline" for="enable_f">
                                                <input type="radio" id="enavle_f" name="enable" value="0" /> 停用
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