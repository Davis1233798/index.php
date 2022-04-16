<!DOCTYPE html>
<head>
    <?php include('layout/common.php');?>
</head>

<body class="grey">
<?php include('layout/menu.php');?>
<img src="images/top/cbanner.png" class="img-responsive">

<div class="wrapper">
    <div class="container inner">
        <div class="home-title">鉛作業問卷<span class="border"></span></div>

        <!--    <p class="c04-form-text">請確實檢查確認事項，以了解您的狀況。若無以下情況，請按下一步。</p>-->

        <ul class="c04-form">
            <div style="height:40px;font-size: 25px;font-weight:bold;color: #00CC00;">個人作業經歷</div>

            <li style="font-weight:bold;">身分證字號(護照號碼)：
                <input style="color: #1e7e34; width: 256px; height: 28px;font-size: 80%;" type="text" id="txt_id_passport" value="<? echo ($_SESSION[$_env['site_code'].'_survey_pb']['ID']!='')?$_SESSION[$_env['site_code'].'_survey_pb']['ID']:''; ?>" >
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
                        <option value="<? echo $k; ?>" id="job_now_<? echo $k; ?>" name="job_now" value="<? echo $v ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_pb']['job_now']==''&&$k=='3')||$_SESSION[$_env['site_code'].'_survey_pb']['job_now']=='4')?'checked':''; ?> /><? echo $v ?></label>
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

            <li style="font-weight:bold;">從事鉛作業平均每日工時為
                <select id="worktime"style="color: #1e7e34; width: 66px; height: 28px;font-size: 80%;">
                    <? for($i=0;$i<=12;$i+=0.5){?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?}?>
                </select>
                小時
            </li>

            <li style="font-size:25px;font-weight:bold;color: #00CC00;">既往病史  您是否曾患有下列慢性疾病：</li>
            <li style="font-weight:bold;">心臟血管：</li>
            <ul>
                <? foreach($_env['past_heart_pb'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_past_heart_pb_<? echo $k; ?>" name="cb_past_heart_pb" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_pb']['past_heart_pb']==''&&$k=='6')||$_SESSION[$_env['site_code'].'_survey_pb']['past_heart_pb']=='6')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">神經系統：</li>
            <ul>
                <? foreach($_env['past_nervous_pb'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_past_nervous_pb_<? echo $k; ?>" name="cb_past_nervous_pb" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_pb']['past_nervous_pb']==''&&$k=='3')||$_SESSION[$_env['site_code'].'_survey_pb']['past_nervous_pb']=='3')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">消化系統：</li>
            <ul>
                <? foreach($_env['past_digestive_pb'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_past_digestive_pb_<? echo $k; ?>" name="cb_past_digestive_pb" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_pb']['past_digestive_pb']==''&&$k=='4')||$_SESSION[$_env['site_code'].'_survey_pb']['past_digestive_pb']=='4')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">生殖系統_男:</li>
            <ul>
                <? foreach($_env['past_rep_pb_men'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_past_rep_pb_men_<? echo $k; ?>" name="cb_past_rep_pb_men" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_pb']['past_rep_pb_men']==''&&$k=='3')||$_SESSION[$_env['site_code'].'_survey_pb']['past_rep_pb_men']=='3')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">生殖系統_女:</li>
            <ul>
                <? foreach($_env['past_rep_pb_women'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_past_rep_pb_women_<? echo $k; ?>" name="cb_past_rep_pb_women" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_pb']['past_rep_pb_women']==''&&$k=='5')||$_SESSION[$_env['site_code'].'_survey_pb']['past_rep_pb_women']=='5')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">其他:</li>
            <ul>
                <? foreach($_env['past_other_pb'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_past_other_pb_<? echo $k; ?>" name="cb_past_other_pb" value="<? echo $k ?>"
                            <? echo (($_SESSION[$_env['site_code'].'_survey_pb']['past_other_pb']==''&&$k=='4')||$_SESSION[$_env['site_code'].'_survey_pb']['past_other_pb']=='4')?'checked':''; ?> /><? echo $v ?></label>
                    <input style="color: #1e7e34; width: 256px; height: 28px;font-size: 80%;" type="<? echo $k=='3' ?'text':'hidden'?>" placeholder="其他" id="txt_past_other_pb_<? echo $k; ?>"
                           value="<? echo $_SESSION[$_env['site_code'].'_survey_pb']['txt_past_other_pb']==''?'':$_SESSION[$_env['site_code'].'_survey_pb']['txt_past_other_pb']; ?>" disabled ?>
                <? } ?>
            </ul>
            <li style="height:40px;font-size:25px;font-weight:bold;color: #00CC00;">生活習慣</li>
            <li>請問您過去一個月內是否有吸菸?</li>
            <ul>
                <? foreach($_env['smoke'] as $k=>$v){ ?>
                    <label><input type="radio" id="rd_smoke_<? echo $k; ?>" name="rd_smoke" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_pb']['smoke']==''&&$k=='1')||$_SESSION[$_env['site_code'].'_survey_pb']['smoke']=='1')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li>請問您最近六個月內是否有嚼食檳榔？</li>
            <ul>
                <? foreach($_env['binlang'] as $k=>$v){ ?>
                    <label><input type="radio" id="rd_binlang_<? echo $k; ?>" name="rd_binlang" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_pb']['binlang']==''&&$k=='1')||$_SESSION[$_env['site_code'].'_survey_pb']['binlang']=='1')?'checked':''; ?> />
                        <? echo $v ?></label>
                <? } ?>
            </ul>
            <li>請問您過去一個月內是否有喝酒？</li>
            <ul>
                <? foreach($_env['wine'] as $k=>$v){ ?>
                    <label><input type="radio" id="rd_wine_<? echo $k; ?>" name="rd_wine" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey_pb']['wine']==''&&$k=='1')||$_SESSION[$_env['site_code'].'_survey_pb']['wine']=='1')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="height:40px;font-size: 25px;font-weight:bold;color: #00CC00;">自覺症狀</li>
            <li style="font-weight:bold;">心臟血管:</li>
            <ul>
                <? foreach($_env['self_heart_pb'] as $k=>$v){ ?>
                    <label><input type="checkbox" name="cb_self_heart_pb" value="<? echo $k ?>"  /> <? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">神經系統:</li>
            <ul>
                <? foreach($_env['self_nervous_pb'] as $k=>$v){ ?>
                    <label><input type="checkbox" name="cb_self_nervous_pb" value="<? echo $k ?>"/> <? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">泌尿系統:</li>
            <ul>
                <? foreach($_env['self_urinary_pb'] as $k=>$v){ ?>
                    <label><input type="checkbox" name="self_urinary_pb" value="<? echo $k ?>"/> <? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">消化系統:</li>
            <ul>
                <? foreach($_env['self_digestive_pb'] as $k=>$v){ ?>
                    <label><input type="checkbox" name="self_digestive_pb" value="<? echo $k ?>"/> <? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">生殖系統:</li>
            <ul>男
                <? foreach($_env['self_rep_pb'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_self_rep_pb_<?echo $k?>" name="cb_self_rep_pb" value="<? echo $k ?>"/> <? echo $v ?></label>
                <? } ?>
            </ul>
            <li style="font-weight:bold;">其他:
                <input style="color: #1e7e34; width: 156px; height: 28px;font-size: 80%;" type="text" placeholder="其他" id="txt_other_self" value="<? echo ($_SESSION[$_env['site_code'].'_survey_pb']['other_self_pb']!='')?$_SESSION[$_env['site_code'].'_survey_pb']['other_self_pb']:''; ?>">
            </li>
        </ul>
        <span></span>
        <div class="btn" style="font-weight:bold;font-size:120%;"><label><input type="checkbox" id="chk_confirm" />已確認以上檢查確認事項資料無誤</label></div>

        <div class="btn">
            <a href="javascript:send_pb()" class="next">送出問卷</a>
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

    //過往內分泌
    $("input[type='checkbox'][name='cb_past_heart_pb']").change(function() {
        if($("#cb_past_heart_pb_1").prop('checked')==false &&
            $("#cb_past_heart_pb_2").prop('checked')==false&&
            $("#cb_past_heart_pb_3").prop('checked')==false&&
            $("#cb_past_heart_pb_4").prop('checked')==false&&
            $("#cb_past_heart_pb_5").prop('checked')==false&&
            $("#cb_past_heart_pb_6").prop('checked')==false)

        {
            $("#cb_past_heart_pb_6").prop('checked',true);
        }else{
            $("#cb_past_heart_pb_6").prop('checked',false);
        };
    });

    //過往神經
    $("input[type='checkbox'][name='cb_past_nervous_pb']").change(function(){
        if ($("#cb_past_nervous_pb_1").prop('checked')==false &&
            $("#cb_past_nervous_pb_2").prop('checked')==false)
        {
            $("#cb_past_nervous_pb_3").prop('checked', true);
        }else{
            $("#cb_past_nervous_pb_3").prop('checked', false);
        };
    });
    //過往消化
    $("input[type='checkbox'][name='cb_past_digestive_pb']").change(function(){
        if ($("#cb_past_digestive_pb_1").prop('checked')==false &&
            $("#cb_past_digestive_pb_2").prop('checked')==false &&
            $("#cb_past_digestive_pb_3").prop('checked')==false)
        {
            $("#cb_past_digestive_pb_4").prop('checked', true);
        }else{
            $("#cb_past_digestive_pb_4").prop('checked', false);
        };
    });
    //過往生殖_男
    $("input[type='checkbox'][name='cb_past_rep_pb_men']").change(function(){
        if ($("#cb_past_rep_pb_men_1").prop('checked')==false &&
            $("#cb_past_rep_pb_men_2").prop('checked')==false)
        {
            $("#cb_past_rep_pb_men_3").prop('checked', true);
            $("input[type='checkbox'][name='cb_past_rep_pb_women']").prop('disabled', false);
        }else{
            $("#cb_past_rep_pb_men_3").prop('checked', false);
            $("input[type='checkbox'][name='cb_past_rep_pb_women']").prop('disabled', true);
        };
    });
    //過往生殖_女
    $("input[type='checkbox'][name='cb_past_rep_pb_women']").change(function(){
        if ($("#cb_past_rep_pb_women_1").prop('checked')==false &&
            $("#cb_past_rep_pb_women_2").prop('checked')==false &&
            $("#cb_past_rep_pb_women_3").prop('checked')==false &&
            $("#cb_past_rep_pb_women_4").prop('checked')==false)
        {
            $("#cb_past_rep_pb_women_5").prop('checked', true);
            $("input[type='checkbox'][name='cb_past_rep_pb_men']").prop('disabled', false);
        }else{
            $("#cb_past_rep_pb_women_5").prop('checked', false);
            $("input[type='checkbox'][name='cb_past_rep_pb_men']").prop('disabled', true);
        };
    });
    //過往_其他
    $("input[type='checkbox'][name='cb_past_other_pb']").change(function(){
        if($("#cb_past_other_pb_3").prop('checked')){
            $("#txt_past_other_pb_3").prop('disabled', false);
        }else{
            $("#txt_past_other_pb_3").prop('disabled', true);
        };
        if ($("#cb_past_other_pb_1").prop('checked')==false &&
            $("#cb_past_other_pb_2").prop('checked')==false &&
            $("#cb_past_other_pb_3").prop('checked')==false)
        {
            $("#cb_past_other_pb_4").prop('checked', true);
        } else{
            $("#cb_past_other_pb_4").prop('checked', false);
        };
    });
    //自覺生殖
    $("input[type='checkbox'][name='cb_self_rep_pb']").change(
        function() {
            if ($("#cb_self_rep_pb_2").prop('checked')) {            
                $("#cb_self_rep_pb_1").prop('checked', false);
            };
            if ($("#cb_self_rep_pb_1").prop('checked')) {                
                $("#cb_self_rep_pb_2").prop('checked', false);
            };
        }
    ); 

    //送出問卷到ajax
    function send_pb(){

        if($('#chk_confirm').prop('checked')===false){
            alert('請確認以上檢查確認事項資料無誤');
            return;
        }
        var past_heart_pb='',
            past_nervous_pb='',
            past_digestive_pb='',
            past_rep_pb_men = '',
            past_rep_pb_women = '',
            past_other_pb = '',
            self_heart_pb = '' ,
            self_nervous_pb = '',
            self_urinary_pb = '';
        $.each($("input[name='cb_past_heart_pb']:checked"), function(){
            past_heart_pb+=$(this).val();
        });
        $.each($("input[name='past_nervous_pb']:checked"), function(){
            past_nervous_pb+=$(this).val();
        });
        $.each($("input[name='past_digestive_pb']:checked"), function(){
            past_digestive_pb+=$(this).val();
        });
        $.each($("input[name='cb_past_rep_pb_men']:checked"), function(){
            past_rep_pb_men+=$(this).val();
        });
        $.each($("input[name='cb_past_rep_pb_women']:checked"), function(){
            past_rep_pb_women+=$(this).val();
        });
        $.each($("input[name='past_other_pb']:checked"), function(){
            past_other_pb+=$(this).val();
        });
        $.each($("input[name='cb_self_heart_pb']:checked"), function(){
            self_heart_pb+=$(this).val();
        });
        $.each($("input[name='cb_self_nervous_pb']:checked"), function(){
            self_nervous_pb+=$(this).val();
        });
        $.each($("input[name='self_urinary_pb']:checked"), function(){
            self_urinary_pb+=$(this).val();
        });
        $.each($("input[name='self_rep_pb']:checked"), function(){
            self_rep_pb+=$(this).val();
        });
        sys_set_loading(true);
        var smoke=$("input[name='rd_smoke']:checked").val(),
            wine=$("input[name='rd_wine']:checked").val(),
            binlang=$("input[name='rd_binlang']:checked").val();

        $.ajax({
            type: "POST",
            url: "include/ajax.php",
            data: {
                "fn": "survey_pb",
                "ID":$('#txt_id_passport').val(),
                "hire_date_s" : $('#txt_hire_date_s_y').val()+'/'+$('#txt_hire_date_s_m').val()+'/'+$('#txt_hire_date_s_d').val(),
                "job_now" : $("#job_now").val(),
                "start_date_s" : $('#txt_start_date_s_y').val()+'/'+$('#txt_start_date_s_m').val(),
                "daily_working_hour":$('#worktime').val(),
                "past_heart_pb": past_heart_pb,
                "past_nervous_pb": past_nervous_pb,
                "past_digestive_pb": past_digestive_pb,
                "past_rep_pb_men":past_rep_pb_men,
                "past_rep_pb_women":past_rep_pb_women,
                "past_other_pb":past_other_pb,
                "txt_other_past":$("#txt_other_past_3").val(),
                "smoke":smoke,
                "smoke_habbit":smoke==3?$('#smoke_daily').val()+'^'+$('#smoke_year').val():'',
                "smoke_fix":smoke==4?$('#smoke_fix_y').val()+'^'+$('#smoke_fix_m').val():'',
                "binlang":binlang,
                "binlang_habbit":binlang==3?$('#binlang_daily').val()+'^'+$('#binlang_year').val():'',
                "binlang_fix":binlang==4?$('#binlang_fix_y').val()+'^'+$('#binlang_fix_m').val():'',
                "wine":wine,
                "wine_habbit":wine==3?$('#wine_weekly').val()+'^'+$('#wine_type').val()+'^'+$('#wine_quota').val():'',
                "wine_fix":wine==4?$('#wine_fix_y').val()+'^'+$('#wine_fix_m').val():'',
                "self_heart_pb":self_heart_pb,
                "self_nervous_pb":self_nervous_pb,
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
