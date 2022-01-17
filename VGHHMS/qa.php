<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
<?php include('layout/menu.php');?> 
<?
  // 載入資料
  $page = get_get("p", 1);
  $get_cate = get_get("c", 1);
  $para = array();
  $order = array("sort"=>"a");

  $sql = 'SELECT id, title FROM faq_category WHERE inuse = 1 ORDER BY sort ASC';
  $cate = $db->doselect($sql);

  if(chk_is_int($get_cate)===false) $get_cate = $cate[0]['id'];

  if(!empty($get_cate)){
    $para = array('cate'=>$get_cate);
  }else if(!empty($cate[0])){
    // $data = $db->doselect($sql, array('cate'=>$cate[0]['id']));
    $para = array('cate'=>$cate[0]['id']);
  }
  $sql = 'SELECT id, question, answer FROM faq 
          WHERE category_id = :cate AND inuse = 1 ';
  $data = $db->doselect_page($sql, $para, $order, $page, 10);
?>
<img src="images/top/newsbanner.png" class="img-responsive">

<div class="wrapper">
 <div class="container">
  <div class="home-title">常見問題Q&amp;A<span class="border"></span></div>
  <ul class="qa-btn">
    <? foreach($cate as $key => $value){ ?>
      <li <? echo ($value['id']==$get_cate)?'class="current"':((empty($get_cate)&&$key==0)?'class="current"':''); ?>>
        <a href="qa.php?c=<?php echo $value['id']?>"><? echo $value['title'];?></a>
      </li>
    <? }?>
  </ul>
  
  <div id="st-accordion" class="st-accordion">
    <ul>
      <? foreach($data['data'] as $key => $value){ ?>
        <li>
           <a href="#"><? echo $value['question']; ?><span class="st-arrow">詳細內容</span></a>
              <div class="st-content">
                <p><? echo nl2br($value['answer']); ?></p>
              </div>
        </li>
      <? }?>
     </ul>
  </div>
  
  <div class="page">
   <ul>
    <li><a href="<? echo ($page<=1)?'javascript:void(0)':'qa.php?'.(!empty($get_cate)?"c=".$get_cate."&":"").'p='.($page-1) ?>">上一頁</a></li>
    <li>第
      <select id="sel_page">
        <? for($i=1; $i<=$data['pager']['total_pages'];$i++){?> 
          <option value="<? echo $i; ?>" <? if($page==$i){ echo "selected"; }?> ><? echo $i?></option>
        <? }?> 
      </select> 頁
    </li>
    <li><a href="<? echo ($page>=$data['pager']['total_pages'])?'javascript:void(0)':'qa.php?'.(!empty($get_cate)?"c=".$get_cate."&":"").'p='.($page+1) ?>">下一頁</a></li>
   </ul>
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
      
      $('#sel_page').change(function(){
        location.href = "qa.php?<? echo (!empty($get_cate)?"c=".$get_cate."&":"").'p='; ?>"+$(this).val();
      });
    });
</script>