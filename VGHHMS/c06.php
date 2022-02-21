<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
    <link rel="stylesheet" href="lib/accordion/css/style.css"> 
</head>

<body class="grey">
<?php include('layout/menu.php');?> 
<img src="images/top/cbanner.png" class="img-responsive">

<div class="wrapper">
<div class="container inner">
  <div class="home-title">健檢推薦<span class="border"></span></div>
  <div class="step-text">STEP 3</div>

  <p class="c04-form-text">依據您的初步條件，推薦給您下列健診組套，<br>
  若您有興趣預約檢查，請於想要檢查的組套前空格中打勾，並按下下方「下一步，開始預約」按鈕<br>
  填寫您的預約資料。</p>

  <?
    if(!array_key_exists($_env['site_code'].'_recommand', $_SESSION)||!$_SESSION[$_env['site_code'].'_recommand']){
      echo '<script>location.replace("c01.php");</script>';
      return;
    }
    
    $quet = $_SESSION[$_env['site_code'].'_recommand'];// 填答結果

    // 推薦套組
    $is_panless = (count($quet['heart_sick'])>0)?false:true;// 判斷是否推薦無痛
    $is_smoke = $quet['smoke']=='1'?true:false;// 判斷是否推薦低肺
    
    $sql = 'SELECT c.type, p.id, p.name, p.price 
            FROM health_package p 
            INNER JOIN health_package_class c ON p.class_id = c.id 
            WHERE p.is_recommand = 1 AND p.inuse = 1 ';
    
    if($quet['age']=='3'){
      // 年紀>78，只推薦乙狀結鏡
      $sql .= 'AND p.id IN (1, 3) ';
    } else {
      

      if(!($quet['gender']=='1'&&$quet['age']=='2'&&count($quet['heart_sick'])>0)){
        $sql .= 'AND p.id <> 19 ';
      }

      if($is_panless===false){
        $sql .= 'AND p.is_painless <> 1 ';
      } else {
        $sql .= 'AND p.id NOT IN (1, 3) ';
      }

      if($is_smoke===false){
        $sql .= 'AND p.id <> 17 ';
      }
    }
    $sql .= 'ORDER BY c.sort, c.id, p.sort, p.id';
    $data_recommand_package = $db->doselect($sql);
    $data_recommand_package_1 = array_filter($data_recommand_package, function($row){ return $row['type']=='1'; });
    $data_recommand_package_2 = array_filter($data_recommand_package, function($row){ return $row['type']=='2'; });

    // 推薦自費
    $data_recommand_self = array();
    if($quet['gender']=='0'&&$quet['age']=='2'){
      $sql = 'SELECT id, name, price FROM self_pay_item WHERE id IN (22, 19, 18, 23, 17, 15, 21, 16, 7, 9, 10, 1, 2) AND inuse = 1 ORDER BY id';
      $data_recommand_self = $db->doselect($sql);
    } else if($quet['gender']=='1'&&$quet['age']=='2'&&$quet['sick']=='1'){
      $sql = 'SELECT id, name, price FROM self_pay_item WHERE id IN (32, 33, 4, 5, 26, 24, 25) AND inuse = 1 ORDER BY id';
      $data_recommand_self = $db->doselect($sql);
    }
  ?>

  <div class="c06-left">
    <p class="check-style-2">推薦組套</p>
    <ul class="reserve-1">
      <li>
        <p class="r-1a">&nbsp;</p>
        <p class="r-2a">健檢組套</p>
        <p class="r-3a">費用</p>
      </li>
    </ul>
    <ul class="reserve-2">
      <? foreach($data_recommand_package_1 as $row){ ?>
        <li>
          <p class="r-1a"><label><input type="checkbox" name="chk_health_package_1" data-id="<? echo $row['id'] ?>" /></label></p>
          <p class="r-2a"><? echo $row['name']; ?></p>
          <p class="r-3a"><? echo $row['price']; ?></p>
        </li>
      <? } ?>
    </ul>
  </div>
  <div class="c06-right">
    <p class="check-style-2">加購檢查</p>
    <ul class="reserve-1">
      <li>
        <p class="r-1a">&nbsp;</p>
        <p class="r-2a">項目</p>
        <p class="r-3a">費用</p>
      </li>
    </ul>
    <ul class="reserve-2">
    <? foreach($data_recommand_package_2 as $row){ ?>
        <li>
          <p class="r-1a"><label><input type="checkbox" name="chk_health_package_2" data-id="<? echo $row['id'] ?>" /></label></p>
          <p class="r-2a"><? echo $row['name']; ?></p>
          <p class="r-3a"><? echo $row['price']; ?></p>
        </li>
      <? } ?>
      <? foreach($data_recommand_self as $row){ ?>
        <li>
          <p class="r-1a"><label><input type="checkbox" name="chk_self_pay_item" data-id="<? echo $row['id'] ?>" /></label></p>
          <p class="r-2a"><? echo $row['name']; ?></p>
          <p class="r-3a"><? echo $row['price']; ?></p>
        </li>
      <? } ?>
    </ul>
  </div>
  <div class="clearfix"></div>

  <div id="st-accordion" class="st-accordion">
    <ul>
      <li>
        <a href="#"><? echo $_env['package_type']['1']; ?>(只能選擇一種<? echo $_env['package_type']['1']; ?>)<span class="st-arrow">Open or Close</span></a>
        <?
          // 取得健檢套組類別
          $sql = 'SELECT id, name FROM health_package_class WHERE `type` = 1 ORDER BY sort, id';
          $data_class = $db->doselect($sql);
        ?>
        <div class="st-content">
          <? foreach($data_class as $row){ ?>
            <ul class="reserve-1">
              <li>
                <p class="r-1">&nbsp;</p>
                <p class="r-2">No.</p>
                <p class="r-3"><? echo $row['name'] ?></p>
                <p class="r-4">執行日期</p>
                <p class="r-5">費用</p>
              </li>
            </ul>
            <ul class="reserve-2">
              <?
                $sql = 'SELECT id, name, workday, price FROM health_package WHERE class_id = :class_id AND inuse = 1 ORDER BY sort, id';
                $data = $db->doselect($sql, array('class_id'=>$row['id']));
                $max = count($data);
                for($i=0;$i<$max;$i++){
                  ?>
                    <li>
                      <p class="r-1"><label><input type="checkbox" name="chk_health_package_1" data-id="<? echo $data[$i]['id'] ?>" /></label></p>
                      <p class="r-2"><? echo $i+1; ?></p>
                      <p class="r-3"><? echo $data[$i]['name']; ?></p>
                      <p class="r-4"><? echo $data[$i]['workday']; ?></p>
                      <p class="r-5"><? echo $data[$i]['price']; ?></p>
                    </li>
                  <?
                }
                unset($data);
                unset($max);
              ?>
            </ul>
          <? } ?>
        </div>
      </li>
    </ul>
  </div>

  <div id="st-accordion2" class="st-accordion">
    <ul>
      <li>
        <a href="#">高階檢查(可搭配基本組套或單獨選擇施作)<span class="st-arrow">Open or Close</span></a>
        <?
          // 取得高階檢查類別
          $sql = 'SELECT id, name FROM health_package_class WHERE `type` = 2 ORDER BY sort, id';
          $data_class = $db->doselect($sql);
        ?>
        <div class="st-content">
          <? foreach($data_class as $row){ ?>
            <ul class="reserve-1">
              <li>
                <p class="r-1">&nbsp;</p>
                <p class="r-2">No.</p>
                <p class="r-3"><? echo $row['name'] ?></p>
                <p class="r-4">執行日期</p>
                <p class="r-5">費用</p>
              </li>
            </ul>
            <ul class="reserve-2">
              <?
                $sql = 'SELECT id, name, workday, price FROM health_package WHERE class_id = :class_id AND inuse = 1 ORDER BY sort, id';
                $data = $db->doselect($sql, array('class_id'=>$row['id']));
                $max = count($data);
                for($i=0;$i<$max;$i++){
                  ?>
                    <li>
                      <p class="r-1"><label><input type="checkbox" name="chk_health_package_2" data-id="<? echo $data[$i]['id'] ?>" /></label></p>
                      <p class="r-2"><? echo $i+1; ?></p>
                      <p class="r-3"><? echo $data[$i]['name']; ?></p>
                      <p class="r-4"><? echo $data[$i]['workday']; ?></p>
                      <p class="r-5"><? echo $data[$i]['price']; ?></p>
                    </li>
                  <?
                }
                unset($data);
                unset($max);
              ?>
            </ul>
          <? } ?>
        </div>
      </li>
    </ul>
  </div>

  <div id="st-accordion3" class="st-accordion">
    <ul>
      <li>
        <a href="#">其他自費加選項目<span class="st-arrow">Open or Close</span></a>
        <div class="st-content">
          <ul class="reserve-1">
            <li>
              <p class="r-1a">&nbsp;</p>
              <p class="r-2a">加項項目</p>
              <p class="r-3a">費用</p>
            </li>
          </ul>
          <ul class="reserve-2">
            <?
              $sql = 'SELECT i.id, i.name, i.price 
                      FROM self_pay_item i 
                      INNER JOIN self_pay_item_class c ON i.class_id = c.id 
                      WHERE i.inuse = 1 
                      ORDER BY c.sort, c.id, i.sort, i.id';
              $data = $db->doselect($sql);
              foreach($data as $row){
            ?>
                <li>
                  <p class="r-1a"><label><input type="checkbox" name="chk_self_pay_item" data-id="<? echo $row['id'] ?>" /></label></p>
                  <p class="r-2a"><? echo $row['name']; ?></p>
                  <p class="r-3a"><? echo $row['price']; ?></p>
                </li>
            <?
              }
              unset($data);
            ?>
          </ul>
        </div>
      </li>
    </ul>
  </div>


  <div class="btn">
    <a href="javascript:go_next()" class="next">下一步</a>
    <a href="#" class="cancel">取消</a>
  </div>

  <div class="clearfix"></div>
</div>
</div>


<?php include('layout/footer.php');?> 

</body>
</html>
<script type="text/javascript" src="js/jquery.accordion.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript">
  $(function() {
    $('#st-accordion').accordion();
    $('#st-accordion2').accordion();
    $('#st-accordion3').accordion();
  });

  function go_next(){
    var health_package_1 = [], 
      health_package_2 = [],
      self_pay_item = [];
    $("input[name='chk_health_package_1']:checked").each(function(){
      var id = $(this).data('id');
      if(health_package_1.indexOf(id)<0) health_package_1.push(id);
    });
    $("input[name='chk_health_package_2']:checked").each(function(){
      var id = $(this).data('id');
      if(health_package_2.indexOf(id)<0) health_package_2.push(id);
    });
    $("input[name='chk_self_pay_item']:checked").each(function(){
      self_pay_item.push($(this).data('id'));
    });

    if(health_package_1.length>1){
      alert('<? echo $_env['package_type']['1']; ?>只能選擇一項');
      return;
    } else if(health_package_1.length==0&&health_package_2.length==0){
      alert('請至少選擇一種套組');
      return;
    }

    sys_set_loading(true);
    $.ajax({
        type: "POST",
        url: "include/ajax.php",
        data: {
            "fn": "recommand_3",
            "health_package_1": JSON.stringify(health_package_1),
            "health_package_2": JSON.stringify(health_package_2),
            "self_pay_item": JSON.stringify(self_pay_item),
        },
        success:function(result){
            if(result.ok=='t'){
                location.href = './c07.php';
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
