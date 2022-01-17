<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
</head>

<body>
<?php include('layout/menu.php');?> 
  <? 
  $sql = "SELECT * FROM `about` WHERE 1 = 1 ";
  $data = $db->doselect_first($sql);?>
<img src="images/top/aboutbanner.png" class="img-responsive">

<div class="wrapper">
 <div class="container">
  <div class="home-title">我們的特色<span class="border"></span></div>
  <ul class="info-list">
   <li><span>1</span><p>全國最優質的健檢團隊</p></li>
   <li><span>2</span><p>醫學中心主治醫師專人檢查並負責報告解說</p></li>
   <li><span>3</span><p>醫學中心教授級主治醫師負責內視鏡檢查施作</p></li>
   <li><span>4</span><p>標準一人一室，能充分休息並有個人隱私空間</p></li>
   <li><span>5</span><p>提供全面性、整體健康管理與照護</p></li>
  </ul>
  <div class="info-pic"><img src="<? echo $_env["site_upload_url"].'about/'.$data['filename']?>" class="img-responsive"></div>
  <div class="info-circle">環境介紹</div>
  
 </div>
</div>

 <div class="info-2"><img src="images/02/pic02.jpg" class="img-responsive"></div>
 <div class="info-2"><img src="images/02/pic03.jpg" class="img-responsive"></div>

<?php include('layout/footer.php');?> 
</body>
</html>
