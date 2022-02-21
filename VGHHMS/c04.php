<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
</head>

<body class="grey">
<?php include('layout/menu.php');?> 
<img src="images/top/cbanner.png" class="img-responsive">

<div class="wrapper">
<div class="container inner">
    <div class="home-title">健檢推薦<span class="border"></span></div>
    <div class="step-text">STEP 1</div>

    <p class="c04-form-text">請填寫您的健康資訊，並按下下方「下一步」按鈕我們將推薦適合的健檢組套及其他自費項目。</p>
    <ul class="c04-form">
        <li>1.性別：</li>
        <li><label><input type="radio" name="rd_gender" value="1" checked />男</label> <label><input type="radio" name="rd_gender" value="0" selected />女</label></li>
        <li>2.是否為懷孕婦女? </li>
        <li><label><input type="radio" name="rd_pregnancy" value="1" disabled />是</label> <label><input type="radio" name="rd_pregnancy" value="0" checked disabled />否</label> <label><input type="radio" name="rd_pregnancy" value="2" disabled />不確定</label></li>
        <li>3.年齡：</li>
        <li><label><input type="radio" name="rd_age" value="1" checked />50以下</label> <label><input type="radio" name="rd_age" value="2" />50~78歲</label> <label><input type="radio" name="rd_age" value="3" />79歲以上</label></li>
        <li>4.是否有心血管疾病個人病史或家族病史?</li>
        <li><label><input type="radio" name="rd_sick" value="1" checked />是</label> <label><input type="radio" name="rd_sick" value="0" />否</label></li>
        <li>5.是否有吸菸? </li>
        <li><label><input type="radio" name="rd_smoke" value="1" checked />是</label> <label><input type="radio" name="rd_smoke" value="0" />否</label></li>
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
    $("input[name='rd_gender']").change(function(){
        if($("input[name='rd_gender']:checked").val()==1){
            $("input[name='rd_pregnancy']").attr('checked', false).attr('disabled', true);
            $("input[name='rd_pregnancy'][value='0']").attr('checked', true);
        } else {
            $("input[name='rd_pregnancy']").attr('disabled', false);
        }

    });

    function go_next(){
        var gender = $("input[name='rd_gender']:checked").val(),
            pregnancy, age, sick, smoke, len_pregnancy, len_age, len_sick, len_smoke;

        len_pregnancy = $("input[name='rd_pregnancy']:checked").length;
        switch(len_pregnancy){
            case 0:
                alert('請選擇是否為懷孕婦女');
                return;
            default:
                alert('懷孕婦女選擇錯誤');
                return;
            case 1:
                break;
        }

        len_age = $("input[name='rd_age']:checked").length;
        switch(len_age){
            case 0:
                alert('請選擇年齡');
                return;
            default:
                alert('年齡選擇錯誤');
                return;
            case 1:
                break;
        }

        len_sick = $("input[name='rd_sick']:checked").length;
        switch(len_sick){
            case 0:
                alert('請選擇病史');
                return;
            default:
                alert('病史選擇錯誤');
                return;
            case 1:
                break;
        }

        len_smoke = $("input[name='rd_smoke']:checked").length;
        switch(len_smoke){
            case 0:
                alert('請選擇是否吸菸');
                return;
            default:
                alert('是否吸菸選擇錯誤');
                return;
            case 1:
                break;
        }

        sys_set_loading(true);
        $.ajax({
            type: "POST",
            url: "include/ajax.php",
            data: {
                "fn": "recommand_1",
                "gender": $("input[name='rd_gender']:checked").val(),
                "pregnancy": $("input[name='rd_pregnancy']:checked").val(),
                "age": $("input[name='rd_age']:checked").val(),
                "sick": $("input[name='rd_sick']:checked").val(),
                "smoke": $("input[name='rd_smoke']:checked").val(),
            },
            success:function(result){
                if(result.ok=='t'){
                    location.href = './c05.php';
                } else if(result.ok=='P') {
                    alert(result.msg);
                    location.replace('c01.php')
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