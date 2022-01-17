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
  <p class="home-subtitle">預約總結單</p>
  <div class="col-6">
    <ul class="checkform">
      <li>健檢對象：<? echo $_env['id_type'][$_SESSION[$_env['site_code'].'_recommand']['id_type']]; ?><?php if($_SESSION[$_env['site_code'].'_recommand']['id_type_name']!=''){ echo ' - '.$_SESSION[$_env['site_code'].'_recommand']['id_type_name'] ; } ?></li>
      <li>姓名：<? echo $_SESSION[$_env['site_code'].'_recommand']['name']; ?></li>
      <li>性別：<? echo $_SESSION[$_env['site_code'].'_recommand']['gender']=='1'?'男':'女'; ?></li>
      <li>身分證/護照：<? echo $_SESSION[$_env['site_code'].'_recommand']['identity']; ?></li>
      <li>生日：<? echo $_SESSION[$_env['site_code'].'_recommand']['birthday']; ?></li>
      <li>希望預約日期：<? echo $_SESSION[$_env['site_code'].'_recommand']['resv_date_s'], $_SESSION[$_env['site_code'].'_recommand']['resv_date_e']==''?'':' 到 '.$_SESSION[$_env['site_code'].'_recommand']['resv_date_e']; ?></li>      
    </ul>
  </div>
  <div class="col-6">
    <ul class="checkform">
      <li>聯絡電話(O)：<? echo $_SESSION[$_env['site_code'].'_recommand']['tel_office']; ?></li>
      <li>聯絡電話(H)：<? echo $_SESSION[$_env['site_code'].'_recommand']['tel_home']; ?></li>
      <li>傳真：<? echo $_SESSION[$_env['site_code'].'_recommand']['fax']; ?></li>
      <li>E-mail：<? echo $_SESSION[$_env['site_code'].'_recommand']['mail']; ?></li>
      <li>寄藥地址：<? echo $_SESSION[$_env['site_code'].'_recommand']['add_drug']; ?></li>
      <li>寄報告地址：<? echo $_SESSION[$_env['site_code'].'_recommand']['add_report']; ?></li>
    </ul>
  </div>
  <div class="clearfix"></div>
  
  <?
    // 合計費用
    $total = 0;

    // 取得選取的基本套組
    $sql = 'SELECT name, price FROM health_package WHERE id IN ('.implode(',', $_SESSION[$_env['site_code'].'_recommand']['health_package_1']).')';
    $data_package1 = $db->doselect($sql);
    $str_package1 = array();
    foreach($data_package1 as $row){
      array_push($str_package1, $row['name']);
      $total += $row['price'];
    }

    // 取得選取的進階套組
    $sql = 'SELECT name, price FROM health_package WHERE id IN ('.implode(',', $_SESSION[$_env['site_code'].'_recommand']['health_package_2']).')';
    $data_package2 = $db->doselect($sql);
    $str_package2 = array();
    foreach($data_package2 as $row){
      array_push($str_package2, $row['name']);
      $total += $row['price'];
    }

    // 取得選取的自費項目
    $sql = 'SELECT name, price FROM self_pay_item WHERE id IN ('.implode(',', $_SESSION[$_env['site_code'].'_recommand']['self_pay_item']).')';
    $data_self_pay_item = $db->doselect($sql);
    $str_self_pay_item = array();
    foreach($data_self_pay_item as $row){
      array_push($str_self_pay_item, $row['name']);
      $total += $row['price'];
    }
    $_SESSION[$_env['site_code'].'_recommand']['price'] = $total;
  ?>

  <div class="check-content">
    您已選取的套餐/<br>
    <? echo $_env['package_type']['1'], '：', implode('、', $str_package1); ?><br>
    <? echo $_env['package_type']['2'], '：', implode('、', $str_package2); ?><br>
    加項項目：<? echo implode('、', $str_self_pay_item); ?>
  </div>
  <div class="price">合計費用 <span>NT$ <? echo number_format($total, 0, '.', ','); ?></span></div>
  <div class="check-info">
    如有特殊需求或其他選擇組套等其他問題，請在此留言註記，將由專員與您聯繫<br>
    若非本人預約體檢，請留下預約人的姓名及聯絡電話(國內)，以便後續進行體檢相關事項之聯繫，謝謝！
  </div>

  <div class="check-text"><textarea id="txt_memo" placeholder="備註"><? echo $_SESSION[$_env['site_code'].'_recommand']['memo']==''?'':nl2br($_SESSION[$_env['site_code'].'_recommand']['memo']); ?></textarea></div>

  <div class="btn">
    <a href="javascript:go_next()" class="next">完成預約</a>
    <a href="javascript:location.replace('reserve-3.php')" class="cancel">重新修改</a>
  </div>
</div>
</div>

<?php include('layout/footer.php');?>

</body>
</html>
<script>

    function go_next(){

        sys_set_loading(true);
        $.ajax({
            type: "POST",
            url: "include/ajax.php",
            data: {
                "fn": "recommand_5",
                "memo": $("#txt_memo").val(),
            },
            success:function(result){
                if(result.ok=='t'){
                    alert('網路預約服務選擇之基本組套與預約日期僅供參考，將由專人於2個工作天內與您聯繫確認完成預約。');
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
