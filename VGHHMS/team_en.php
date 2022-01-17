<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
    <link rel="stylesheet" type="text/css" href="lib/fancybox/jquery.fancybox.min.css">
	<script src="lib/fancybox/jquery.fancybox.min.js"></script>
</head>

<body>
<?php include('layout/menu.php');?> 
<?
  // 載入資料
  $sql = 'SELECT id, en_title, en_detail FROM team_category 
  WHERE inuse = 1 AND en_title != "" ORDER BY sort ASC';
  $cate = $db->doselect($sql);

  foreach ($cate as $key => $value){
      $sql = 'SELECT id, en_name, filename, en_division, gender, url FROM team 
            WHERE category_en = :cate AND inuse = 1 ORDER BY sort ASC';
      $data[$key] = $db->doselect($sql, array('cate'=>$value['id']));
  }
?> 
<img src="images/top/aboutbanner.png" class="img-responsive">

<div class="wrapper">
 <div class="container">
  <div class="home-title">About Us<span class="border"></span></div>
  <? foreach ($cate as $key => $value){
    if($value['en_title']!=''){?>
  <div class="team-box">
   <div class="title"><? echo $value['en_title']?> <span><? echo $value['en_detail']?></span></div>
  </div>
  <? }?>
  <? if(!empty($data[$key])){?>
    <ul class="team-list">
      <? 
      foreach ($data[$key] as $key1 => $value1){
        $file = $_env["site_upload_url"].'team/'.$value1['filename'];
        if(!empty($value1['filename'])/*file_exists($file)&&is_file($file)*/){
          $img = $file;
        }else{
          if($value1['gender']==1){
            //$img = 'images/02/d00.jpg';
			$img = 'images/260x180.png';
          }else{
            //$img = 'images/02/d0.jpg';
			$img = 'images/260x180.png';
          }
        }?>
       <li>
        <? if(!empty($value1['url'])){ ?>
          <a href="<? echo $value1['url']?>" target="_blank">
        <? }else{ ?>
          <a data-fancybox data-src="#hidden-content-b" href="javascript:;" class="open" data-id="<? echo $value1['id']?>">
        <? }?>
         <img src="<? echo $img; ?>" class="img-responsive">
         <p><? echo $value1['en_name']?><span><? echo $value1['en_division']?></span></p>
        </a>
       </li>
    <? }?>
      </ul>
  <? }
    }?> 
  
 </div>
</div>


   <div style="display: none;" id="hidden-content-b">
    <div class="block_detail">
         <img src="images/02/d00.jpg" class="img-responsive">
         <p class="doctor">Wan-Leong Chan<span>MD, LMCHK, FACC</span></p>
         <ul class="block-en">
          <li>Medical licenses：</li>
          <li>
           <p>Specialty Board of Society of Internal Medicine</p>
           <p>Specialty Board of Taiwan Society of Cardiology</p>
          </li>
          <li>Education：</li>
          <li>
           <p>M.D National Defense Medical Center, Taiwan, R.O.C</p>
           <p>M.D National Defense Medical Center, Taiwan, R.O.C</p>
           <p>M.D National Defense Medical Center, Taiwan, R.O.C</p>
          </li>
          <li>Professional experience：</li>
          <li>
           <p>Chief, Healthcare & Services, Veterans General Hospital, Taipei, Taiwan, R.O.C</p>
           <p>Chief, Healthcare & Services, Veterans General Hospital, Taipei, Taiwan, R.O.C</p>
           <p>Chief, Healthcare & Services, Veterans General Hospital, Taipei, Taiwan, R.O.C</p>

          </li>
         </ul>
    </div>
  </div>

<?php include('layout/footer.php');?> 
<script>
	$(function(){
		$(".block-en").mCustomScrollbar({
			theme:"dark", // 設定捲軸樣式
		});
	});
  $('.open').on('click', function(){
    $.ajax({
      url:'ajax_team_en.php',
      data:{
        "id":$(this).data('id'),
      },
      type:'POST',
      success:function(result){
        console.log(result);
        if(result.ok=='t'){
          $('#hidden-content-b').html(result.html);
          $(".block-en").mCustomScrollbar({
            theme:"dark", // 設定捲軸樣式
          });
        }
      },
      error:function(xhr, ajaxOptions, thrownError){
        sys_ajax_error(xhr, ajaxOptions, thrownError);
      },
      datatype:"json"
    })
  })
</script>
</body>
</html>
