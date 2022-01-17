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
  <div class="home-title">About Us<span class="border"></span></div>
  <ul class="info-btn">
   <li class="current"><a href="#">Introduction</a></li>
   <li><a href="team_en.php">Our members</a></li>
  </ul>
  <p class="info-title">Taipei Veterans General Hospital Health Screening Program</p>
  <p class="info-text-en">An ounce of prevention is worth a pound of cure, and the most effective prevention is a routine health check. Taipei Veterans General Hospital has prusued this purpose for improving national health since being founded in 1968.</p>
  <p class="info-title">About us</p>
  <ul class="info-list-en">
   <li>Best medical center recognized by the Department of Health.</li>
   <li>Leaded by an experienced medical team and specialists.</li>
   <li>Exclusive medical diagnostic operating system.</li>
   <li>Comfortable private rooms with facilities.</li>
   <li>When medically indicated, patients will be referred to other subspecialty for further diagnosis and management.</li>
  </ul>
  
  <div class="info-pic"><img src="<? echo $_env["site_upload_url"].'about/'.$data['filename']?>" class="img-responsive"></div>
  <div class="info-circle-en">Environmental introduction</div>
  
 </div>
</div>

 <div class="info-2"><img src="images/02/pic02.jpg" class="img-responsive"></div>
 <div class="info-2"><img src="images/02/pic03.jpg" class="img-responsive"></div>

<?php include('layout/footer.php');?> 
</body>
</html>
