<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
</head>

<body class="grey">
<?php include('layout/menu.php');?> 
<img src="images/top/cbanner.png" class="img-responsive">

<div class="wrapper">
<div class="container inner">
    <div class="home-title">粉塵作業問卷<span class="border"></span></div>

    <p class="c04-form-text">請確實檢查確認事項，以了解您的狀況。若無以下情況，請按下一步。</p>

    <ul class="c04-form">
        <li>若您有以下情況，請打勾：</li>
        <li>重度的心臟疾病：
            <?
                foreach($_env['heart_sick'] as $k=>$v){
                    echo '<label><input type="checkbox" name="chk_heart_sick" value="', $k, '" />', $v, '</label> ';
                    if(in_array($k, array('5', '8', '9'))) echo '<br />';
                }
            ?>    
        </li>
        <li>您目前是否有使用抗凝血劑，如：</li>
        <li>
            <?
                foreach($_env['drug'] as $k=>$v){
                    echo '<label><input type="checkbox" name="chk_drug" value="', $k, '"/>', $v, '</label> ';
                }
            ?>
        </li>
        <li>若您有藥物過敏史，請填寫過敏藥物名稱：</li>
        <li><input type="text" class="c04-text" id="txt_allergy"></li>
        <li>若您為三個月內住院者，請填寫住院原因：</li>
        <li><input type="text" class="c04-text" id="txt_hospitalization"></li>
        <li><label><input type="checkbox" id="chk_confirm" />已確認以上檢查確認事項資料無誤</label></li>
    </ul>
    <div class="btn">
        <a href="javascript:go_next()" class="next">下一步</a>
    </div>

    <div class="clearfix"></div>
</div>
</div>


<?php include('layout/footer.php');?> 
</body>
</html>
<script>
    function go_next(){
        var heart_sick = [],
            drug = [];

        if($('#chk_confirm').prop('checked')===false){
            alert('請確認以上檢查確認事項資料無誤');
            return;
        }

        $.each($("input[name='chk_heart_sick']:checked"), function(){
            heart_sick.push($(this).val());
        });

        $.each($("input[name='chk_drug']:checked"), function(){
            drug.push($(this).val());
        });

        sys_set_loading(true);
        $.ajax({
            type: "POST",
            url: "include/ajax.php",
            data: {
                "fn": "recommand_2",
                "heart_sick": JSON.stringify(heart_sick),
                "drug": JSON.stringify(drug),
                "allergy": $("#txt_allergy").val(),
                "hospitalization": $("#txt_hospitalization").val(),
            },
            success:function(result){
                if(result.ok=='t'){
                    location.href = './reserve-3.php';
                } else {
                    alert(result.msg);
                }
                sys_set_loading(false);
            },
            error:function(xhr, ajaxOptions, thrownError){
                sys_ajax_error(xhr, ajaxOptions, thrownError);
            },
            datatype:"json"
        });
    }
</script>
