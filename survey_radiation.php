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
        <li style="height: 30px;">
        受雇日期： <span class="rwd-block"style="margin: 0;padding: 0;border: 0;outline: 0;font-size: 100%;font: inherit;">
		  <span class="rwd-block">
         <select id="txt_resv_date_s_y"style="color: #1e7e34; width: 66px; height: 28px;font-size: 80%;">
		 <?php for($i=date('Y');$i>date('Y')-30;$i--){ ?>
             <option value="<?php echo $i ?>" <?php echo $resv_date_sArray[0]==$i?'selected':''; ?> ><?php echo $i ?></option>
         <?php } ?>
         </select>
         <select id="txt_resv_date_s_m"style="color: #1e7e34; width: 46px; height: 28px;font-size: 80%;">
          <?php for($i=1;$i<=12;$i++){ ?>
              <option value="<?php echo $i ?>" <?php echo $resv_date_sArray[1]==$i?'selected':''; ?> ><?php echo $i ?></option>
          <?php } ?>
         </select>
         <select id="txt_resv_date_s_d"style="color: #1e7e34; width: 46px; height: 28px;font-size: 80%;">
          <?php for($i=1;$i<=31;$i++){ ?>
              <option value="<?php echo $i ?>" <?php echo $resv_date_sArray[2]==$i?'selected':''; ?> ><?php echo $i ?></option>
          <?php } ?>
         </select>
         </span>

          　目前從事：<input type="text" style="width:350px" class="c04-text" id="txt_hospitalization"> 起始日期：

		  <span class="rwd-block">
         <select id="txt_resv_date_s_y" style="color: #1e7e34; width: 66px; height: 28px;font-size: 80%;">
		 <?php for($i=date('Y');$i>date('Y')-30;$i--){ ?>
             <option value="<?php echo $i ?>" <?php echo $resv_date_sArray[0]==$i?'selected':''; ?> ><?php echo $i ?></option>
         <?php } ?>
         </select>
         <select id="txt_resv_date_s_m"style="color: #1e7e34; width: 46px; height: 28px;font-size: 80%;">
          <?php for($i=1;$i<=12;$i++){ ?>
              <option value="<?php echo $i ?>" <?php echo $resv_date_sArray[1]==$i?'selected':''; ?> ><?php echo $i ?></option>
          <?php } ?>
         </select>
        </span>
        </li>
        <li>
        </li>
        <li>從事游離輻射作業平均每日工時為
            <select id="worktime"style="color: #1e7e34; width: 66px; height: 28px;font-size: 80%;">
                <? for($i=0;$i<=12;$i+=0.5){?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?}?>
            </select>小時
        </li>
        <li>既往病史  您是否曾患有下列慢性疾病：</li>
        <li> 內 分 泌：<label><input type="radio" id="nay" name="rd_nay" value="" <? echo (($_SESSION[$_env['site_code'].'_recommand']['id_type']==''&&$k=='1')||$_SESSION[$_env['site_code'].'_recommand']['id_type']=='1')?'checked':''; ?> /><? echo $v ?></label>
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
