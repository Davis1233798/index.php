<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
    <link rel="stylesheet" href="lib/accordion/css/style.css"> 
</head>

<body class="grey">
<?php include('layout/menu.php');?> 
<img src="images/top/enbanner.png" class="img-responsive">

<div class="wrapper">
<div class="container">
  <div class="home-title">網路預約<span class="border"></span></div>
  <!-- <p class="home-subtitle">預約基本資料(註明<span class="red">*</span>號為必填欄位)</p> -->

  <div id="st-accordion" class="st-accordion">
    <ul>
      <li>
        <a href="#"><? echo $_env['package_type']['1']; ?>（只能選擇一種健檢組套）<span class="st-arrow">Open or Close</span></a>
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
        <a href="#"><? echo $_env['package_type']['2']; ?>（僅可搭配基本組套，不可以單獨施作）<span class="st-arrow">Open or Close</span></a>
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
                $sql = 'SELECT id, name, workday, price FROM health_package WHERE class_id = :class_id  AND inuse = 1 ORDER BY sort, id';
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
        <?
          // 取得類別列表
          $sql = 'SELECT id, name FROM self_pay_item_class ORDER BY sort, id';
          $data_class = $db->doselect($sql);
          foreach($data_class as $row_class){
              $sql = 'SELECT id, name, price FROM self_pay_item WHERE class_id = :class_id AND inuse = 1 ORDER BY sort, id';
              $data = $db->doselect($sql, array('class_id'=>$row_class['id']));
        ?>
          <ul class="reserve-1">
            <li>
              <p class="r-1a">&nbsp;</p>
              <p class="r-2a"><? echo $row_class['name']; ?></p>
              <p class="r-3a">費用</p>
            </li>
          </ul>
          <ul class="reserve-2">
            <? foreach($data as $row){ ?>
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
        <?
          }
          unset($data_class);
        ?>
        </div>
      </li>
    </ul>
  </div>
    
  <div class="btn">
    <a href="javascript:go_next()" class="next">下一步</a>
    <a href="#" class="cancel">取消</a>
  </div>
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
                location.href = './reserve-2.php';
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
