<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?>
</head>

<body class="grey">
<?php include('layout/menu.php');?> 
<img src="images/top/enbanner.png" class="img-responsive">

<div class="wrapper">
<div class="container">
  <div class="home-title">健檢推薦<span class="border"></span></div>
  <div class="step-text">STEP 4</div>
  <div class="info-text-ch">預約基本資料(註明*為必填欄位)</div>
  <ul class="reserveform">
    <li>*健檢對象： 
      <? foreach($_env['id_type'] as $k=>$v){ ?>
        <label><input type="radio" id="rd_id_type_<? echo $k; ?>" name="rd_id_type" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_recommand']['id_type']==''&&$k=='1')||$_SESSION[$_env['site_code'].'_recommand']['id_type']=='1')?'checked':''; ?> /><? echo $v ?></label> 
      <? } ?>
      <input type="text" placeholder="公司名稱" id="txt_id_type_name" value="<? echo ($_SESSION[$_env['site_code'].'_recommand']['id_type']=='7'&&$_SESSION[$_env['site_code'].'_recommand']['id_type_name']!='')?$_SESSION[$_env['site_code'].'_recommand']['id_type_name']:''; ?>" <? echo $_SESSION[$_env['site_code'].'_recommand']['id_type']=='7'?'':'disabled'; ?>>
    </li>
    <li><input type="text" placeholder="*姓名" id="txt_name" value="<? echo $_SESSION[$_env['site_code'].'_recommand']['name']==''?'':$_SESSION[$_env['site_code'].'_recommand']['name']; ?>" maxlength="100" ></li>
    <li>*性別： <label><input type="radio" id="rd_gender_1" name="rd_gender" value="1" checked/>男</label> <label><input type="radio" id="rd_gender_0" name="rd_gender" value="0"/>女</label></li>
    <li><input type="text" placeholder="*身分證/護照" id="txt_identity" value="<? echo $_SESSION[$_env['site_code'].'_recommand']['identity']==''?'':$_SESSION[$_env['site_code'].'_recommand']['identity']; ?>" maxlength="20" ></li>
    <li><input type="text" placeholder="*生日" class="datepicker-here" id="txt_birthday"></li>
    <li><input type="text" placeholder="*希望預約日期，請選擇區間" class="datepicker-here" id="txt_resv_date_s"></li>
        <li><label for="to">到</label></li>
        <li><input type="text" placeholder="*希望預約日期，請選擇區間" class="datepicker-here" id="txt_resv_date_e"></li>
    <li><input type="text" placeholder="*寄藥地址" id="txt_add_drug" value="<? echo $_SESSION[$_env['site_code'].'_recommand']['add_drug']==''?'':$_SESSION[$_env['site_code'].'_recommand']['add_drug']; ?>" maxlength="100" ></li>
    <li>(腸鏡事前灌腸準備藥物)</li>
    <li><input type="text" placeholder="*寄報告地址" id="txt_add_report" value="<? echo $_SESSION[$_env['site_code'].'_recommand']['add_report']==''?'':$_SESSION[$_env['site_code'].'_recommand']['add_report']; ?>" maxlength="100" ></li>
    <li class="formbtn"><a href="javascript:same_add_click()">同上</a></li>
    <li><input type="text" placeholder="*聯絡電話(H)" id="txt_tel_home" value="<? echo $_SESSION[$_env['site_code'].'_recommand']['tel_home']==''?'':$_SESSION[$_env['site_code'].'_recommand']['tel_home']; ?>" maxlength="20" ></li>
    <li><input type="text" placeholder="*聯絡電話(O)" id="txt_tel_office" value="<? echo $_SESSION[$_env['site_code'].'_recommand']['tel_office']==''?'':$_SESSION[$_env['site_code'].'_recommand']['tel_office']; ?>" maxlength="20" ></li>
    <li><input type="text" placeholder="*行動電話"  id="txt_mobile" value="<? echo $_SESSION[$_env['site_code'].'_recommand']['mobile']==''?'':$_SESSION[$_env['site_code'].'_recommand']['mobile']; ?>" maxlength="20" ></li>
    <li><input type="text" placeholder="傳真" id="txt_fax" value="<? echo $_SESSION[$_env['site_code'].'_recommand']['fax']==''?'':$_SESSION[$_env['site_code'].'_recommand']['fax']; ?>" maxlength="20" ></li>
    <li><input type="text" placeholder="*電子郵件" id="txt_mail" value="<? echo $_SESSION[$_env['site_code'].'_recommand']['mail']==''?'':$_SESSION[$_env['site_code'].'_recommand']['mail']; ?>" maxlength="50" ></li>
  </ul>


  <div class="btn">
    <a href="javascript:go_next()" class="next">下一步，確認預約</a>
    <a href="#" class="cancel">取消</a>
  </div>
</div>
</div>

<?php include('layout/footer.php');?>

</body>
</html>
<link href="lib/air/datepicker.min.css" rel="stylesheet" type="text/css">
<script src="lib/air/datepicker.js"></script>
<script>
var $start = $('#txt_resv_date_s'),
	$end = $('#txt_resv_date_e');
	$birthday = $('#txt_birthday');	
	
	$start.datepicker({
		language: 'en',
		onSelect: function (fd, date) {
			$end.data('datepicker')
				.update('minDate', date)
		}
	})
	
	
	$end.datepicker({
		language: 'en',
		onSelect: function (fd, date) {
			$start.data('datepicker')
				.update('maxDate', date)
		}
	})
	
	
	$birthday.datepicker({
		language: 'en',
		'maxDate': new Date()
	})
	
  
  $(function(){
    $('#txt_resv_date_s, #txt_resv_date_e').datepicker({
      'minDate': new Date()
    });

    $("input[type='radio'][name='rd_id_type']").change(function(){
      if($(this).val()==7){
        $("#txt_id_type_name").prop('disabled', false);
      } else {
        $("#txt_id_type_name").prop('disabled', true);
      }
    });

    <?
      if(array_key_exists('id_type', $_SESSION[$_env['site_code'].'_recommand']))
        echo '$("#rd_id_type_', $_SESSION[$_env['site_code'].'_recommand']['id_type'],'").attr("checked", true);';

      if(array_key_exists('gender', $_SESSION[$_env['site_code'].'_recommand'])&&$_SESSION[$_env['site_code'].'_recommand']['gender']!='1')
        echo '$("#rd_gender_0").attr("checked", true);';

      if(array_key_exists('birthday', $_SESSION[$_env['site_code'].'_recommand']))
        echo '$("#txt_birthday").datepicker().data("datepicker").selectDate(new Date("'.DATE('Y-m-d', strtotime($_SESSION[$_env['site_code'].'_recommand']['birthday'])).'"));';

      if(array_key_exists('resv_date_s', $_SESSION[$_env['site_code'].'_recommand']))
        echo '$("#txt_resv_date_s").datepicker().data("datepicker").selectDate(new Date("'.DATE('Y-m-d', strtotime($_SESSION[$_env['site_code'].'_recommand']['resv_date_s'])).'"));';

      if(array_key_exists('resv_date_e', $_SESSION[$_env['site_code'].'_recommand'])&&$_SESSION[$_env['site_code'].'_recommand']['resv_date_e']!='')
        echo '$("#txt_resv_date_e").datepicker().data("datepicker").selectDate(new Date("'.DATE('Y-m-d', strtotime($_SESSION[$_env['site_code'].'_recommand']['resv_date_e'])).'"));';
    ?>

  });

  function same_add_click(){
    if($('#txt_add_drug').val()!='') $('#txt_add_report').val($('#txt_add_drug').val());
  }

  function go_next(){
    
    var birthday = $('#txt_birthday').datepicker().data('datepicker').selectedDates,
      resv_dates_s = $('#txt_resv_date_s').datepicker().data('datepicker').selectedDates,
      resv_dates_e = $('#txt_resv_date_e').datepicker().data('datepicker').selectedDates;
      
    if(birthday.length==0){
      alert('請選擇生日');
      return;
    }
    if(resv_dates_s.length==0){
      alert('請選擇希望預約日期');
      return;
    }
      
    sys_set_loading(true);
    var id_type = $("input[name='rd_id_type']:checked").val();
    $.ajax({
        type: "POST",
        url: "include/ajax.php",
        data: {
            "fn": "recommand_4",
            "id_type" : id_type,
            "id_type_name" : id_type==7?$("#txt_id_type_name").val():'',
            "name" : $('#txt_name').val() ,
            "gender" : $("input[name='rd_gender']:checked").val(),
            "identity" : $('#txt_identity').val(),
            "birthday" : birthday[0].getFullYear()+'/'+(birthday[0].getMonth()+1)+'/'+birthday[0].getDate(),
            "resv_date_s" : resv_dates_s[0].getFullYear()+'/'+(resv_dates_s[0].getMonth()+1)+'/'+resv_dates_s[0].getDate(),
            "resv_date_e" : resv_dates_e.length==1?resv_dates_e[0].getFullYear()+'/'+(resv_dates_e[0].getMonth()+1)+'/'+resv_dates_e[0].getDate():'',
            "add_drug" : $('#txt_add_drug').val(),
            "add_report" : $('#txt_add_report').val(),
            "tel_home" : $('#txt_tel_home').val(),
            "tel_office" : $('#txt_tel_office').val(),
            "mobile" : $('#txt_mobile').val(),
            "fax" : $('#txt_fax').val(),
            "mail" : $('#txt_mail').val(),
        },
        success:function(result){
            if(result.ok=='t'){
                location.href = './c08.php';
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