<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
</head>

<body>
<?php include('layout/menu.php');?> 
<img src="images/top/newsbanner.png" class="img-responsive">

<div class="wrapper">
 <div class="container">
  <div class="title">NEWS</div>
  <ul class="newslist">
    <?
      // 載入資料
      $page = get_get("p", 1);
      $para = array();
      $order = array("DATE(start_date)"=>"d", "sort"=>"a");
      $sql = 'SELECT id, start_date, en_title, en_content, default_img, filename 
              FROM news WHERE inuse = 1 AND ((start_date<=NOW() AND end_date>NOW()) OR (end_date = "0000-00-00")) 
              AND en_title !="" AND en_content != "" ';
      $data = $db->doselect_page($sql, $para, $order, $page, 10);

      $sql = 'SELECT id, filename FROM news_img WHERE 1 = 1';
      $news_img = $db->doselect($sql);
      $imageAry = array();
      foreach ($news_img as $key => $value) {
        $imageAry[ $value['id'] ] = $value['filename'];
      }
      // $first_id = get_get('id', count($data)==0?0:$data[0]['id']);//querystring有傳入id，則帶出id的資料，否則抓第一筆資料id
      foreach ($data['data'] as $row){
        if($row['default_img']==0){
          $img = $_env["site_upload_url"].'news/'.$row['filename'];
        }else{
          $img = $_env["site_upload_url"].'news/'.$imageAry[ $row['default_img'] ];
        }
    ?>
   <li>
    <div class="newspic"> 
     <a href="detail_en.php<? echo '?id='.$row['id'];?>"><img src="<? echo $img;?>" class="img-responsive"></a>
    </div>
    <div class="newsbox">
     <p class="news-date"><? echo $row['start_date']?></p>
     <p class="news-title"><? echo $row['en_title']?></p>
     <p class="news-text"><? echo $row['en_content']?></p>
     <a href="detail_en.php<? echo '?id='.$row['id'];?>"><img src="images/more.jpg" class="more"></a>
    </div>
   </li>
   <? } ?>
  </ul>
  
  <div class="page">
   <ul>
    <li><a href="<? echo ($page<=1)?'javascript:void(0)':'news_en.php?p='.($page-1) ?>">PREV</a></li>
    <li>
      <select id="sel_page">
        <? for($i=1; $i<=$data['pager']['total_pages'];$i++){?> 
          <option <? if($page==$i){ echo "selected"; }?> ><? echo $i?></option>
        <? }?> 
      </select> PAGES</li>
    <li><a href="<? echo ($page>=$data['pager']['total_pages'])?'javascript:void(0)':'news_en.php?p='.($page+1) ?>">NEXT</a></li>
   </ul>
  </div> 
  
 </div>
</div>

<?php include('layout/footer.php');?> 
<script type="text/javascript">
  $('#sel_page').on('change', function(){
      window.location.href='news_en.php?p='+$(this).val();
  })
</script>
</body>
</html>
