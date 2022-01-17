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
  $sql = 'SELECT id, title, detail FROM team_category WHERE inuse = 1 ORDER BY sort ASC';
  $cate = $db->doselect($sql);

  foreach ($cate as $key => $value){
    $sql = 'SELECT id, name, filename, division, gender, url FROM team 
            WHERE category_id = :cate AND inuse = 1 ORDER BY sort ASC';
    $data[$key] = $db->doselect($sql, array('cate'=>$value['id']));
  }
?>
<img src="images/top/aboutbanner.png" class="img-responsive">

<div class="wrapper">
 <div class="container">
  <? foreach ($cate as $key => $value){?>
  <div class="team-box">
   <div class="title"><? echo $value['title']?> <span><? echo $value['detail']?></span></div>
  </div>
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
         <p><? echo $value1['name']?><span><? echo $value1['division']?></span></p>
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
         <p class="doctor">林幸榮 醫師/教授<span>心臟內科</span></p>
         <ul class="block">
          <li>學歷：</li>
          <li>
           <p>臺北醫學大學 醫學士(M.D.)</p>
           <p>美國哥倫比亞大學(Columbia University) 醫學博士(Ph.D.)</p>
          </li>
          <li>學歷：</li>
          <li>
           <p>臺北醫學大學 醫學士(M.D.)</p>
           <p>美國哥倫比亞大學(Columbia University) 醫學博士(Ph.D.)</p>
           <p>臺北醫學大學 醫學士(M.D.)</p>
           <p>美國哥倫比亞大學(Columbia University) 醫學博士(Ph.D.)</p>
           <p>臺北醫學大學 醫學士(M.D.)</p>
           <p>美國哥倫比亞大學(Columbia University) 醫學博士(Ph.D.)</p>
           <p>臺北醫學大學 醫學士(M.D.)</p>
           <p>美國哥倫比亞大學(Columbia University) 醫學博士(Ph.D.)</p>
           <p>臺北醫學大學 醫學士(M.D.)</p>
           <p>美國哥倫比亞大學(Columbia University) 醫學博士(Ph.D.)</p>
          </li>
         </ul>
     </div>
    </div>
<?php include('layout/footer.php');?> 

<script>
	$(function(){
		$(".block").mCustomScrollbar({
			theme:"dark", // 設定捲軸樣式
		});
	});
  $('.open').on('click', function(){
    $.ajax({
      url:'ajax_team.php',
      data:{
        "id":$(this).data('id'),
      },
      type:'POST',
      success:function(result){
        console.log(result);
        if(result.ok=='t'){
          $('#hidden-content-b').html(result.html);
          $(".block").mCustomScrollbar({
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
