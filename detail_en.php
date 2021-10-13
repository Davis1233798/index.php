<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
</head>

<body>
<?php include('layout/menu.php');?> 
<img src="images/top/newsbanner.png" class="img-responsive">

<div class="wrapper">
 <div class="container">
  <div class="main">
  <?
    $id = get_get("id");
    $sql = "SELECT id, start_date, en_title, en_content, img FROM `news` 
            WHERE id = :id AND inuse = 1 AND ((start_date<=NOW() AND end_date>NOW()) OR (end_date = '0000-00-00')) 
            AND en_title !='' AND en_content != ''";
    $data = $db->doselect_first($sql, array("id"=>$id));
    if(empty($data)){
      echo "<script>window.location.href='news.php';</script>";
    }
  ?>
   <p class="detail-title-en"><? echo $data['en_title'];?></p>
   <p class="news-date"><? echo $data['start_date'];?></p>
   <? if($data['img']!=''&&file_exists($_env["site_upload_path"].'news/'.$data['img'])){ ?>
    <img src="<? echo $_env["site_upload_url"].'news/'.$data['img']?>" class="detail-pic">
   <? } ?>
   <div class="detail-text">
     <p><? echo nl2br($data['en_content']);?></p>
   </div>
  </div>
  
  <div class="back">
   <a href="news_en.php" class="hvr-fade">BACK</a>
  </div>
  
 </div>
</div>

<?php include('layout/footer.php');?> 
</body>
</html>
