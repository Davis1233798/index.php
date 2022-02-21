<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");

$id = get_get("id");
$sql = "SELECT * FROM meal WHERE id = :id";
$data = $db->doselect_first($sql, array("id"=>$id));

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
                                <a href="index.php"><? echo $_pageenv["fn_name"]; ?></a> - <? echo $_pageenv["fn_name_edit"]; ?>
                            </div>
                            <form method="POST" action="save.php?fn=edit" enctype="multipart/form-data">
                                <div class="card-block">
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="txt_name"><i style="color: red;">* </i>代餐編號</label>
                                        <div class="col-md-4">
                                            <input type="text" id="txt_name" name="txt_name" class="form-control" placeholder="請輸入代餐編號" maxlength="100" value="<? echo $data["meal_ID"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="txt_workday"><i style="color: red;">* </i>代餐名稱</label>
                                        <div class="col-md-4">
                                            <input type="text" id="txt_workday" name="txt_workday" class="form-control" placeholder="請輸入代餐名稱" maxlength="20" value="<? echo $data["meal_name"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="txt_price"><i style="color: red;">* </i>費用</label>
                                        <div class="col-md-4">
                                            <input type="text" id="txt_price" name="txt_price" class="form-control" placeholder="請輸入費用" maxlength="11" value="<? echo $data["price"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="remark"><i style="color: red;"></i>代餐內容</label>
                                        <div class="col-md-4">
                                            <textarea id="remark" name="remark" rows="9" class="form-control" placeholder="請輸入代餐內容"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="rd_vegetarian">葷素食</label>
                                        <div class="col-md-6">
                                            <label class="radio-inline" for="rd_vegetarian_t">
                                                <input type="radio" id="rd_vegetarian_t" name="rd_vegetarian" value="1" <? echo $data['vegetarian']=='1'?'checked':''; ?> /> 葷食
                                            </label>
                                            <label class="radio-inline" for="rd_vegetarian_f">
                                                <input type="radio" id="rd_vegetarian_f" name="rd_vegetarian" value="2" <? echo $data['vegetarian']=='2'?'checked':''; ?> /> 素食
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="rd_enable">是否啟用</label>
                                        <div class="col-md-6">
                                            <label class="radio-inline" for="rd_enable_t">
                                                <input type="radio" id="rd_enable_t" name="rd_enable" value="1" <? echo $data['enable']=='1'?'checked':''; ?> /> 啟用
                                            </label>
                                            <label class="radio-inline" for="rd_enable_f">
                                                <input type="radio" id="rd_enable_f" name="rd_enable" value="0" <? echo $data['enable']=='0'?'checked':''; ?> /> 停用
                                            </label>
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
<script>
    // 選擇流程說明 啟用/停用
    $("input[type='radio'][name='rd_show_flow']").change(function(){
        if($(this).val()=='1'){
            $('#hl_card').prop('href', '#card_flow')
            if(!$('#card_flow').hasClass('in')) $('#hl_card').click();
        } else {
            if($('#card_flow').hasClass('in')) $('#hl_card').click();
            $('#hl_card').prop('href', '');
        }
    });
</script>


