<!DOCTYPE html>
<head>
    <?php include('layout/common.php');?>
</head>

<body class="grey">
<?php include('layout/menu.php');?>
<img src="images/top/cbanner.png" class="img-responsive">

<div class="wrapper">
    <div class="container inner">
        <div class="home-title">游離作業問卷<span class="border"></span></div>

        <!--    <p class="c04-form-text">請確實檢查確認事項，以了解您的狀況。若無以下情況，請按下一步。</p>-->

        <ul class="c04-form">
            <div style="height:40px;font-size: 25px;font-weight:bold;color: #00CC00;">個人作業經歷</div>

            <li style="font-weight:bold;">身分證字號(護照號碼)：
                <input style="color: #1e7e34; width: 256px; height: 28px;font-size: 80%;" type="text" id="txt_id_passport" value="<? echo ($_SESSION[$_env['site_code'].'_survey_radiation']['ID']!='')?$_SESSION[$_env['site_code'].'_survey_radiation']['ID']:''; ?>" >
            </li>
            <li style="font-weight:bold;">
                受僱日期： 民國
                <select id="txt_hire_date_s_y"style="color: #1e7e34; width: 50px; height: 28px;font-size: 80%;">
                    <?php for($i=date('Y')-1911;$i>date('Y')-1971;$i--){ ?>
                        <option value="<?php echo $i ?>" <?php echo $hire_date_sArray[0]==$i?'selected':''; ?> ><?php echo $i ?></option>
                    <?php } ?>
                </select>
                <select id="txt_hire_date_s_m"style="color: #1e7e34; width: 46px; height: 28px;font-size: 80%;">
                    <?php for($i=1;$i<=12;$i++){ ?>
                        <option value="<?php echo $i ?>" <?php echo $hire_date_sArray[1]==$i?'selected':''; ?> ><?php echo $i ?></option>
                    <?php } ?>
                </select>
                <select id="txt_hire_date_s_d"style="color: #1e7e34; width: 46px; height: 28px;font-size: 80%;">
                    <?php for($i=1;$i<=31;$i++){ ?>
                        <option value="<?php echo $i ?>" <?php echo $hire_date_sArray[2]==$i?'selected':''; ?> ><?php echo $i ?></option>
                    <?php } ?>
                </select>
            </li>
            <li style="font-weight:bold;">目前從事：
                <select id="job_now" style="color: #1e7e34; width: 306px; height: 28px;font-size: 80%;">
                    <? foreach($_env['job_now'] as $k=>$v){ ?>
                        <option value="<? echo $k; ?>" id="job_now_<? echo $k; ?>" name="job_now" value="<? echo $v ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_radiation']['job_now']==''&&$k=='3')||$_SESSION[$_env['site_code'].'_survey_radiation']['job_now']=='4')?'checked':''; ?> /><? echo $v ?></label>
                    <? } ?>
                </select>
            </li>
            <li style="font-weight:bold;">起始日期： 民國
                <select id="txt_start_date_s_y" style="color: #1e7e34; width: 50px; height: 28px;font-size: 80%;">
                    <?php for($i=date('Y')-1911;$i>date('Y')-1971;$i--){ ?>
                        <option value="<?php echo $i ?>" <?php echo $start_date_sArray[0]==$i?'selected':''; ?> ><?php echo $i ?></option>
                    <?php } ?>
                </select>
                <select id="txt_start_date_s_m"style="color: #1e7e34; width: 46px; height: 28px;font-size: 80%;">
                    <?php for($i=1;$i<=12;$i++){ ?>
                        <option value="<?php echo $i ?>" <?php echo $start_date_sArray[1]==$i?'selected':''; ?> ><?php echo $i ?></option>
                    <?php } ?>
                </select>
            </li>

            <li style="font-weight:bold;">從事游離輻射作業平均每日工時為
                <select id="worktime"style="color: #1e7e34; width: 66px; height: 28px;font-size: 80%;">
                    <? for($i=0;$i<=12;$i+=0.5){?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?}?>
                </select>
                小時
            </li>

            <li style="font-size:25px;font-weight:bold;color: #00CC00;">既往病史  您是否曾患有下列慢性疾病：</li>
            <li style="font-weight:bold;">內分泌：</li>
            <ul>
                <? foreach($_env['endocrine_past_radiation'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_endocrine_past_<? echo $k; ?>" name="cb_endocrine_past" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_radiation']['endocrine_past_radiation']==''&&$k=='3')||$_SESSION[$_env['site_code'].'_survey_radiation']['endocrine_past_radiation']=='4')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">血液疾病：</li>
            <ul>
                <? foreach($_env['blood_past_radiation'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_blood_past_radiation_<? echo $k; ?>" name="cb_blood_past_radiation" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_radiation']['blood_past_radiation']==''&&$k=='4')||$_SESSION[$_env['site_code'].'_survey_radiation']['blood_past_radiation']=='4')?'checked':''; ?> /><? echo $v ?></label>
                    <input style="color: #1e7e34; width: 156px; height: 28px;font-size: 80%;" type="<? echo $k=='3' ?'text':'hidden'?>" placeholder="其他" id="txt_blood_past_radiation_<? echo $k; ?>" value="<? echo ($_SESSION[$_env['site_code'].'_survey_radiation']['blood_past']=='3'&&$_SESSION[$_env['site_code'].'_survey_radiation']['blood_past_radiation']!='')?$_SESSION[$_env['site_code'].'_survey_radiation']['blood_past_radiation']:''; ?>" <? echo $_SESSION[$_env['site_code'].'_survey_radiation']['other_self_radiation']=='3'?'':'disabled'; ?>>
                <? } ?>

            </ul>
            <li style="font-weight:bold;">肝臟疾病：</li>
            <ul>
                <? foreach($_env['liver_past_radiation'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_liver_past_radiation_<? echo $k; ?>" name="cb_liver_past_radiation" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_radiation']['liver_past_radiation']==''&&$k=='6')||$_SESSION[$_env['site_code'].'_survey_radiation']['liver_past_radiation']=='6')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">其他:</li>
            <ul>
                <? foreach($_env['other_past_radiation'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_other_past_radiation_<? echo $k; ?>" name="cb_other_past_radiation" value="<? echo $k ?>" /><? echo $v ?></label>
                    <input style="color: #1e7e34; width: 256px; height: 28px;font-size: 80%;" type="<? echo $k=='10' ?'text':'hidden'?>" placeholder="其他" id="txt_other_past_radiation_<? echo $k; ?>"
                           value="<? echo $_SESSION[$_env['site_code'].'_survey_radiation']['txt_other_past']==''?'':$_SESSION[$_env['site_code'].'_survey_radiation']['txt_other_past']; ?>" disabled ?>
                <? } ?>
            </ul>
            <li style="height:40px;font-size:25px;font-weight:bold;color: #00CC00;">生活習慣</li>
            <li>請問您過去一個月內是否有吸菸?</li>
            <ul>
                <? foreach($_env['smoke'] as $k=>$v){ ?>
                    <label><input type="radio" id="rd_smoke_<? echo $k; ?>" name="rd_smoke" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_radiation']['smoke']==''&&$k=='1')||$_SESSION[$_env['site_code'].'_survey_radiation']['smoke']=='1')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li>請問您最近六個月內是否有嚼食檳榔？</li>
            <ul>
                <? foreach($_env['binlang'] as $k=>$v){ ?>
                    <label><input type="radio" id="rd_binlang_<? echo $k; ?>" name="rd_binlang" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_radiation']['binlang']==''&&$k=='1')||$_SESSION[$_env['site_code'].'_survey_radiation']['binlang']=='1')?'checked':''; ?> />
                        <? echo $v ?></label>
                <? } ?>
            </ul>
            <li>請問您過去一個月內是否有喝酒？</li>
            <ul>
                <? foreach($_env['wine'] as $k=>$v){ ?>
                    <label><input type="radio" id="rd_wine_<? echo $k; ?>" name="rd_wine" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_radiation']['wine']==''&&$k=='1')||$_SESSION[$_env['site_code'].'_survey_radiation']['wine']=='1')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="height:40px;font-size: 25px;font-weight:bold;color: #00CC00;">自覺症狀</li>
            <li style="font-weight:bold;">內分泌系統</li>
            <ul>
                <? foreach($_env['endocrine_self_radiation'] as $k=>$v){ ?>
                    <label><input type="checkbox" name="cb_endocrine_self_radiation" value="<? echo $k ?>"  /> <? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">血液系統</li>
            <ul>
                <? foreach($_env['blood_self_radiation'] as $k=>$v){ ?>
                    <label><input type="checkbox" name="cb_blood_self_radiation" value="<? echo $k ?>"/> <? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">呼吸系統</li>
            <ul>
                <? foreach($_env['breathe_self_radiation'] as $k=>$v){ ?>
                    <label><input type="checkbox" name="cb_breathe_self_radiation" value="<? echo $k ?>"/> <? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">其他</li>
            <ul>
                <? foreach($_env['other_self_radiation'] as $k=>$v){ ?>

                    <label><input type="checkbox" id="cb_other_self_radiation_<? echo $k; ?>" name="cb_other_self_radiation" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_radiation']['other_self_radiation']==''&&$k=='11')||$_SESSION[$_env['site_code'].'_survey_radiation']['other_self_radiation']=='11')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
                <input style="color: #1e7e34; width: 156px; height: 28px;font-size: 80%;" type="text" placeholder="其他" id="txt_other_self" value="<? echo ($_SESSION[$_env['site_code'].'_survey_radiation']['blood_past']=='3'&&$_SESSION[$_env['site_code'].'_survey_radiation']['id_other_self_radiation_name']!='')?$_SESSION[$_env['site_code'].'_survey_radiation']['id_other_self_radiation_name']:''; ?>" <? echo $_SESSION[$_env['site_code'].'_survey_radiation']['other_self_radiation']=='3'?'':'disabled'; ?>>
            </ul>
        </ul>
        <span></span>
        <div class="btn" style="font-weight:bold;font-size:120%;"><label><input type="checkbox" id="chk_confirm" />已確認以上檢查確認事項資料無誤</label></div>

        <div class="btn">
            <a href="javascript:send_radiation()" class="next">送出問卷</a>
        </div>

        <div class="clearfix"></div>
    </div>
</div>


<?php
include('layout/footer.php');

//throw new exception ();
?>
</body>
</html>
<script type="text/javascript"
        src="./js/survey.js">
</script>
<script>
    var lbend = false;
    //過往內分泌
    $("input[type='checkbox'][name='cb_endocrine_past']").change(function() {
        if ($("#cb_endocrine_past_1").prop('checked')){
            $("#cb_endocrine_past_3").prop('checked',false);
        };
        if ($("#cb_endocrine_past_2").prop('checked')) {
            $("#cb_endocrine_past_3").prop('checked',false);
        };
        if($("#cb_endocrine_past_1").prop('checked')==false && $("#cb_endocrine_past_2").prop('checked')==false){
            $("#cb_endocrine_past_3").prop('checked',true);
        };
    });

    //過往血液

    $("input[type='checkbox'][name='cb_blood_past_radiation']").change(function(){

        if($("#cb_blood_past_radiation_1").prop('checked')){
            $("#cb_blood_past_radiation_4").prop('checked', false);
        };
        if($("#cb_blood_past_radiation_2").prop('checked')) {
            $("#cb_blood_past_radiation_4").prop('checked', false);
        };
        if($("#cb_blood_past_radiation_3").prop('checked')){
            $("#cb_blood_past_radiation_4").prop('checked', false);
            $("#txt_blood_past_radiation_3").prop('disabled', false);
        }else{
            $("#txt_blood_past_radiation_3").prop('disabled', true);
        };
        if ($("#cb_blood_past_radiation_1").prop('checked')==false &&
            $("#cb_blood_past_radiation_2").prop('checked')==false &&
            $("#cb_blood_past_radiation_3").prop('checked')==false)
        {
            $("#cb_blood_past_radiation_4").prop('checked', true);
        } else{
            $("#cb_blood_past_radiation_4").prop('checked', false);
        };
    });
    //過往肝臟
    $("input[type='checkbox'][name='cb_liver_past_radiation']").change(function(){
        if($("#cb_liver_past_radiation_1").prop('checked')){
            $("#cb_liver_past_radiation_6").prop('checked', false);
        };
        if($("#cb_liver_past_radiation_2").prop('checked')) {
            $("#cb_liver_past_radiation_6").prop('checked', false);
        };
        if($("#cb_liver_past_radiation_3").prop('checked')){
            $("#cb_liver_past_radiation_6").prop('checked', false);
        };
        if($("#cb_liver_past_radiation_4").prop('checked')){
            $("#cb_liver_past_radiation_6").prop('checked', false);
        };
        if($("#cb_liver_past_radiation_").prop('checked')){
            $("#cb_liver_past_radiation_6").prop('checked', false);
        };
        if ($("#cb_liver_past_radiation_1").prop('checked')==false &&
            $("#cb_liver_past_radiation_2").prop('checked')==false &&
            $("#cb_liver_past_radiation_3").prop('checked')==false &&
            $("#cb_liver_past_radiation_4").prop('checked')==false &&
            $("#cb_liver_past_radiation_5").prop('checked')==false)
        {
            $("#cb_liver_past_radiation_6").prop('checked', true);
        } else{
            $("#cb_liver_past_radiation_6").prop('checked', false);
        };
    });
    //過往其他
    $("input[type='checkbox'][name='cb_other_past_radiation']").change(function(){
        if($("#cb_other_past_radiation_1").prop('checked')){
            $("#cb_other_past_radiation_11").prop('checked', false);
        };
        if($("#cb_other_past_radiation_2").prop('checked')) {
            $("#cb_other_past_radiation_11").prop('checked', false);
        };
        if($("#cb_other_past_radiation_3").prop('checked')){
            $("#cb_other_past_radiation_11").prop('checked', false);
        };
        if($("#cb_other_past_radiation_4").prop('checked')){
            $("#cb_other_past_radiation_11").prop('checked', false);
        };
        if($("#cb_other_past_radiation_5").prop('checked')){
            $("#cb_other_past_radiation_11").prop('checked', false);
        };
        if($("#cb_other_past_radiation_6").prop('checked')){
            $("#cb_other_past_radiation_11").prop('checked', false);
        };
        if($("#cb_other_past_radiation_7").prop('checked')){
            $("#cb_other_past_radiation_11").prop('checked', false);
        };
        if($("#cb_other_past_radiation_8").prop('checked')){
            $("#cb_other_past_radiation_11").prop('checked', false);
        };
        if($("#cb_other_past_radiation_9").prop('checked')){
            $("#cb_other_past_radiation_11").prop('checked', false);
        };
        if($("#cb_other_past_radiation_10").prop('checked')){
            $("#cb_other_past_radiation_11").prop('checked', false);
            $("#txt_other_past_radiation_10").prop('disabled', false);
        }else{
            $("#txt_other_past_radiation_10").prop('disabled', true);
        };

        if ($("#cb_other_past_radiation_1").prop('checked')==false &&
            $("#cb_other_past_radiation_2").prop('checked')==false &&
            $("#cb_other_past_radiation_3").prop('checked')==false &&
            $("#cb_other_past_radiation_4").prop('checked')==false &&
            $("#cb_other_past_radiation_5").prop('checked')==false &&
            $("#cb_other_past_radiation_6").prop('checked')==false &&
            $("#cb_other_past_radiation_7").prop('checked')==false &&
            $("#cb_other_past_radiation_8").prop('checked')==false &&
            $("#cb_other_past_radiation_9").prop('checked')==false &&
            $("#cb_other_past_radiation_10").prop('checked')==false)
        {
            $("#cb_other_past_radiation_11").prop('checked', true);
        } else{
            $("#cb_other_past_radiation_11").prop('checked', false);
        };
    });

    //自覺其他
    $("input[type='checkbox'][id='cb_other_self_radiation_6']").change(
        function() {
            if ($(this).prop('checked')) {
                $("#txt_other_self").prop('disabled', false);
            } else {
                $("#txt_other_self").prop('disabled', true);
            }
        }
    );
    //既往其他

    $("input[type='checkbox'][id='cb_other_past_radiation_10']").change(
        function() {
            if ($(this).prop('checked')) {
                $("#txt_other_past_10").prop('disabled', false);
            } else {
                $("#txt_other_past_10").prop('disabled', true);
            }
        }
    );



    //送出問卷到ajax
    function send_radiation(){

        if($('#chk_confirm').prop('checked')===false){
            alert('請確認以上檢查確認事項資料無誤');
            return;
        }
        var endocrine_past='',
            blood_past='',
            liver_past='',
            other_past = '',
            endocrine_self = '',
            blood_self = '' ,
            breathe_self = '',
            other_self = '';
        $.each($("input[name='cb_endocrine_past_radiation']:checked"), function(){
            endocrine_past+=$(this).val();
        });
        $.each($("input[name='cb_blood_past_radiation']:checked"), function(){
            blood_past+=$(this).val();
        });
        $.each($("input[name='cb_liver_past_radiation']:checked"), function(){
            liver_past+=$(this).val();
        });
        $.each($("input[name='cb_other_past_radiation']:checked"), function(){
            other_past+=$(this).val();
        });
        $.each($("input[name='cb_endocrine_self_radiation']:checked"), function(){
            endocrine_self+=$(this).val();
        });
        $.each($("input[name='cb_blood_self_radiation']:checked"), function(){
            blood_self+=$(this).val();
        });
        $.each($("input[name='cb_breathe_self_radiation']:checked"), function(){
            breathe_self+=$(this).val();
        });
        $.each($("input[name='cb_other_self_radiation']:checked"), function(){
            other_self+=$(this).val();
        });

        sys_set_loading(true);
        var smoke=$("input[name='rd_smoke']:checked").val(),
            wine=$("input[name='rd_wine']:checked").val(),
            binlang=$("input[name='rd_binlang']:checked").val();

        $.ajax({
            type: "POST",
            url: "include/ajax.php",
            data: {
                "fn": "survey_radiation",
                "ID":$('#txt_id_passport').val(),
                "hire_date_s" : $('#txt_hire_date_s_y').val()+'/'+$('#txt_hire_date_s_m').val()+'/'+$('#txt_hire_date_s_d').val(),
                "job_now" : $("#job_now").val(),
                "start_date_s" : $('#txt_start_date_s_y').val()+'/'+$('#txt_start_date_s_m').val(),
                "daily_working_hour":$('#worktime').val(),
                "endocrine_past": endocrine_past,
                "blood_past": blood_past,
                "txt_blood_past":$("#txt_blood_past_radiation_3").val(),
                "liver_past": liver_past,
                "other_past":other_past,
                "txt_other_past":$("#txt_other_past_10").val(),
                "smoke":smoke,
                "smoke_habbit":smoke==3?$('#smoke_daily').val()+'^'+$('#smoke_year').val():'',
                "smoke_fix":smoke==4?$('#smoke_fix_y').val()+'^'+$('#smoke_fix_m').val():'',
                "binlang":binlang,
                "binlang_habbit":binlang==3?$('#binlang_daily').val()+'^'+$('#binlang_year').val():'',
                "binlang_fix":binlang==4?$('#binlang_fix_y').val()+'^'+$('#binlang_fix_m').val():'',
                "wine":wine,
                "wine_habbit":wine==3?$('#wine_weekly').val()+'^'+$('#wine_type').val()+'^'+$('#wine_quota').val():'',
                "wine_fix":wine==4?$('#wine_fix_y').val()+'^'+$('#wine_fix_m').val():'',
                "endocrine_self":endocrine_self,
                "blood_self":blood_self,
                "breathe_self":breathe_self,
                "other_self":other_self,
                "txt_other_self":$('#txt_other_self').val(),

            },
            success:function(result){
                if(result.ok=='t'){
                    alert('問卷填寫完成，感謝您的填寫!');
                    location.replace('./index.php');
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
