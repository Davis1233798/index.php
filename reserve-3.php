<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
</head>

<body class="grey">
<?php include('layout/menu.php');?> 
<img src="images/top/enbanner.png" class="img-responsive">

<div class="wrapper">
<div class="container">
    <div class="home-title">網路預約<span class="border"></span></div>
    <p class="home-subtitle">預約基本資料(註明<span class="red">*</span>號為必填欄位)</p>
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
        <li>
         *生日：
		 
		 <?php 
		 if($_SESSION[$_env['site_code'].'_recommand']['birthday']!=''){
			 $birthdayArray = explode('/',$_SESSION[$_env['site_code'].'_recommand']['birthday']);
		 }
		 ?>
         <span class="rwd-block">
         <select id="txt_birthday_y">
		 <?php for($i=date('Y');$i>date('Y')-100;$i--){ ?>
          <option value="<?php echo $i ?>" <?php echo $birthdayArray[0]==$i?'selected':''; ?> ><?php echo $i ?></option>
		 <?php } ?> 
         </select>
         <select id="txt_birthday_m">
          <?php for($i=1;$i<=12;$i++){ ?>
		  <option value="<?php echo $i ?>" <?php echo $birthdayArray[1]==$i?'selected':''; ?> ><?php echo $i ?></option>
		  <?php } ?> 
         </select>
         <select id="txt_birthday_d">
          <?php for($i=1;$i<=31;$i++){ ?>
		  <option value="<?php echo $i ?>" <?php echo $birthdayArray[2]==$i?'selected':''; ?> ><?php echo $i ?></option>
		  <?php } ?> 
         </select>
         </span>
        </li>
		

		
        <li>
		
         *希望預約日期：
         <span class="rwd-block">
		 
		 
		 <?php 
		 if($_SESSION[$_env['site_code'].'_recommand']['resv_date_s']!=''){
			 $resv_date_sArray = explode('/',$_SESSION[$_env['site_code'].'_recommand']['resv_date_s']);
		 }else{
			 $resv_date_sArray = explode('/',date('Y/n/j'));
		 }
		 ?>
         <span class="rwd-block">
         <select id="txt_resv_date_s_y">
		 <?php for($i=date('Y')+1;$i>date('Y')-1;$i--){ ?>
          <option value="<?php echo $i ?>" <?php echo $resv_date_sArray[0]==$i?'selected':''; ?> ><?php echo $i ?></option>
		 <?php } ?> 
         </select>
         <select id="txt_resv_date_s_m">
          <?php for($i=1;$i<=12;$i++){ ?>
		  <option value="<?php echo $i ?>" <?php echo $resv_date_sArray[1]==$i?'selected':''; ?> ><?php echo $i ?></option>
		  <?php } ?> 
         </select>
         <select id="txt_resv_date_s_d">
          <?php for($i=1;$i<=31;$i++){ ?>
		  <option value="<?php echo $i ?>" <?php echo $resv_date_sArray[2]==$i?'selected':''; ?> ><?php echo $i ?></option>
		  <?php } ?> 
         </select>
         </span>


         <span>到</span>
		 
		 <?php 
		 if($_SESSION[$_env['site_code'].'_recommand']['resv_date_e']!=''){
			 $resv_date_sArray = explode('/',$_SESSION[$_env['site_code'].'_recommand']['resv_date_e']);
		 }else{
			 $resv_date_sArray = explode('/',date('Y/n/j'));
		 }
		 ?>
         <span class="rwd-block">
         <select id="txt_resv_date_e_y">
		 <?php for($i=date('Y')+1;$i>date('Y')-1;$i--){ ?>
          <option value="<?php echo $i ?>" <?php echo $resv_date_sArray[0]==$i?'selected':''; ?> ><?php echo $i ?></option>
		 <?php } ?> 
         </select>
         <select id="txt_resv_date_e_m">
          <?php for($i=1;$i<=12;$i++){ ?>
		  <option value="<?php echo $i ?>" <?php echo $resv_date_sArray[1]==$i?'selected':''; ?> ><?php echo $i ?></option>
		  <?php } ?> 
         </select>
         <select id="txt_resv_date_e_d">
          <?php for($i=1;$i<=31;$i++){ ?>
		  <option value="<?php echo $i ?>" <?php echo $resv_date_sArray[2]==$i?'selected':''; ?> ><?php echo $i ?></option>
		  <?php } ?> 
         </select>
         </span>
		 
        </li>
        
		
		
		
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

	
  $(function(){


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


    ?>

  });

  function same_add_click(){
    if($('#txt_add_drug').val()!='') $('#txt_add_report').val($('#txt_add_drug').val());
  }

  function go_next(){
     
      
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
            "birthday" : $('#txt_birthday_y').val()+'/'+$('#txt_birthday_m').val()+'/'+$('#txt_birthday_d').val(),
            "resv_date_s" : $('#txt_resv_date_s_y').val()+'/'+$('#txt_resv_date_s_m').val()+'/'+$('#txt_resv_date_s_d').val(),
            "resv_date_e" : $('#txt_resv_date_e_y').val()+'/'+$('#txt_resv_date_e_m').val()+'/'+$('#txt_resv_date_e_d').val(),
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
                location.href = './reserve-4.php';
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