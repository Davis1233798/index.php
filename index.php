<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
</head>

<body class="homebg">
<?php include('layout/menu.php');?> 
<div class="wrapper">
 <div class="container">
  <?php include('layout/banner.php');?> 
 </div>
</div>


<div class="wrapper">
<div class="container inner">
  <div class="home-title">健檢項目<span class="border"></span></div>
  <p class="home-subtitle">完善的醫學療程達到內外全然平衡狀態，始能成就人生最大祝福</p>
  <ul class="other-list">
    <?
      // 取得健檢項目類別
      $sql = 'SELECT id, `name`, `filename` FROM health_package_class ORDER BY sort, id';
      $data = $db->doselect($sql);
      foreach($data as $row){
        echo '<li><a href="c01.php?class=', $row['id'], '"><img src="', $_env['site_upload_url'], 'health_package_class/', $row['id'], '/', $row['filename'], '" class="img-responsive"><p>', $row['name'], '</p></a></li>';
      }
      unset($data);
    ?>
  </ul>
</div>
</div>

<div class="wrapper whitebg">
<div class="container inner">
  <div class="home-title">最新訊息<span class="border"></span></div>
    <ul class="newslist">
      <?
        // 取得最新四則新聞
        $sql = 'SELECT id, start_date, title, content, default_img, filename 
                FROM news WHERE inuse = 1 AND start_date<=NOW() AND end_date>NOW() 
                ORDER BY DATE(start_date) DESC, sort ASC 
                limit 4';
        $data = $db->doselect($sql);

        // 取得預設新聞圖
        $sql = 'SELECT id, filename FROM news_img WHERE 1 = 1';
        $news_img = $db->doselect($sql);
        $imageAry = array();
        foreach ($news_img as $key => $value) {
          $imageAry[ $value['id'] ] = $value['filename'];
        }

        foreach($data as $row){
          if($row['default_img']==0){
            $img = $_env["site_upload_url"].'news/'.$row['filename'];
          }else{
            $img = $_env["site_upload_url"].'news/'.$imageAry[ $row['default_img'] ];
          }
      ?>
        <li>
          <div class="newspic"> 
            <a href="detail.php<? echo '?id='.$row['id']; ?>"><img src="<? echo $img; ?>" class="img-responsive"></a>
          </div>
          <div class="newsbox">
            <p class="news-date"><? echo $row['start_date']?></p>
            <p class="news-title"><? echo $row['title']?></p>
            <p class="news-text"><? echo $row['content']?></p>
            <a href="detail.php<? echo '?id='.$row['id'];?>"><img src="images/more.jpg" class="more"></a>
          </div>
        </li>
      <?
        }
        unset($data);
      ?>
    </ul>
    <a href="reserve.php"><img src="images/c01.jpg" class="home-pic"></a>
    <a href="contact.php"><img src="images/c02.jpg" class="home-pic"></a>
    <div class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4295.917486356378!2d121.51998194732982!3d25.121433033853247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442ae8a02baaaab%3A0x61b53cf6dbcd6e93!2z6Ie65YyX5qau5rCR57i96Yar6Zmi!5e0!3m2!1szh-TW!2stw!4v1535525444092" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>
</div>


<?php include('layout/footer.php');?> 
</body>
</html>
