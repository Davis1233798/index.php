<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
</head>

<body>
<?php include('layout/menu.php');?> 
<?
  $sql = 'SELECT * FROM en_health_chk WHERE inuse = 1 ORDER BY sort ASC';
  $data = $db->doselect($sql);

  $detail1 = $detail2 = $detail3 = array();
  foreach ($data as $key => $value){
    if($value['category_id']==1){
      array_push($detail1, $value);
    }elseif($value['category_id']==2){
      array_push($detail2, $value);
    }elseif($value['category_id']==3){
      array_push($detail3, $value);
    }
  }
?>
<img src="images/top/enbanner.png" class="img-responsive">

<div class="wrapper">
 <div class="container">
  <div class="home-title-en">Health Checkup<span class="border"></span></div>
  <p class="check-style-1">Screening Items</p>
  <ul class="item-1">
    <? foreach($detail1 as $key => $value){ ?>
       <li>
        <p class="c01"><? echo $key+1; ?></p>
        <p class="c02"><? echo nl2br($value['content'])?></p>
       </li>
   <? }?>
  </ul>
  <p class="check-style-2">Special examinations (Special endoscopic examination programs)</p>
  <ul class="item-2">
    <? foreach($detail2 as $key => $value){ ?>
       <li>
        <p class="c01"><? echo $key+1; ?></p>
        <p class="c03"><? echo nl2br($value['content']);?></p>
        <p class="c04"><? echo $value['price'];?></p>
       </li>
    <? }?>
  </ul>
  <p class="check-style-3">Selective advanced imaging studies</p>
  <ul class="item-3">
    <? foreach($detail3 as $key => $value){ ?>
       <li>
        <p class="c01"><? echo $key+1; ?></p>
        <p class="c03"><? echo nl2br($value['content']);?></p>
        <p class="c04"><? echo $value['price'];?></p>
       </li>
    <? }?>
  </ul>
  
 </div>
</div>

<?php include('layout/footer.php');?> 
</body>
</html>
