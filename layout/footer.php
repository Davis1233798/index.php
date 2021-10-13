<div class="footer">
 <div class="footer-bg">
  <div class="container">
   <ul class="footer-nav">
    <li><a href="news.php">最新訊息</a></li>
    <li><a href="info.php">關於我們</a></li>
    <li><a href="c01.php">健檢項目/價格</a></li>
    <li><a href="reserve.php">網路預約</a></li>
    <li><a href="qa.php">常見問題</a></li>
    <li><a href="health.php">檢前飲食</a></li>
    <li><a href="contact.php">聯絡我們</a></li>
    <li><a href="news_en.php">ENGLISH</a></li>
   </ul>
  </div>
 </div>

 <div class="container">
  <div class="footer-box">
   <p>地址：112 台北市北投區石牌路二段201號中正樓15樓</p>
   <p>TEL：02-28757225 <span>(一日、二日健檢)</span> ‧ 02-28712121#3641 <span>(重點半日健檢)</span></p>
   <p>因服務電話使用量大，請善用聯絡我們</p>
   <p>FAX：02-28757383</p>
   <p>No.201,Shipai Road Sec 2, Taipei,112,Taiwan</p>
   <p>TEL:+886-2-28757225</p>
  </div>
  <div class="footer-box">
   <ul>
    <li><a href="c01.php">檢查項目與價格介紹</a></li>
    <li><a href="reserve.php">網路預約</a></li>
    <li><a href="tel:02-28757225">健檢預約服務專線</a></li>
    <li><a href="contact.php">聯絡我們</a></li>
   </ul>
  </div>
  <div class="clearfix"></div>
  <p class="copyright">本網站內容所有權歸臺北榮民總醫院所有，請尊重智慧財產權，未經允許請勿任意轉載、複製或做商業用途，禁止任何網際網路服務業者轉錄本網站資訊之內容。</p>
 </div> 
</div>

<div class="gototop"><a href="#"><img src="images/gototop.png" class="img-responsive"></a></div>
<div class="sidemenu">
 <ul>
  <li><a href="c01.php"><img src="images/z01.png"><p>檢查項目與價格介紹</p></a></li>
  <li><a href="reserve.php"><img src="images/z02.png"><p>網路預約</p></a></li>
  <li><a href="tel:02-28757225"><img src="images/z03.png"><p>健檢預約服務專線</p></a></li>
  <li><a href="contact.php"><img src="images/z04.png"><p>聯絡我們</p></a></li>
 </ul>
</div>

<div id="sys_div_loading" style="z-index: 99999; width: 100%; height: 100%; top: 0px; left: 0px; position: absolute; background-color: #666; display: none;"></div>

<script type="text/javascript">
        $(function () {
            $(".gototop").click(function () {
                jQuery("html,body").animate({
                    scrollTop: 0
                }, 1000);
            });
        });

// 載入等待畫面
function sys_set_loading(type){
	if(type) {
		$("#sys_div_loading").height($(document).height())
		.fadeTo("100", "0.3", function(){
			var opts = {
				lines: 10, // The number of lines to draw
				length: 10, // The length of each line
				width: 6, // The line thickness
				radius: 15, // The radius of the inner circle
				corners: 1, // Corner roundness (0..1)
				rotate: 10, // The rotation offset
				direction: 1, // 1: clockwise, -1: counterclockwise
				color: '#70cdd2', // #rgb or #rrggbb or array of colors
				speed: 0.9, // Rounds per second
				trail: 48, // Afterglow percentage
				shadow: true, // Whether to render a shadow
				hwaccel: true, // Whether to use hardware acceleration
				className: 'spinner', // The CSS class to assign to the spinner
				zIndex: 2e9, // The z-index (defaults to 2000000000)
				top: '50%', // Top position relative to parent in px
				left: '50%' // Left position relative to parent in px
			};
		});
	} else if(!type) {
		$("#sys_div_loading").fadeTo("100", "0", function(){ }).hide();
	}
}

// 發生ajax錯誤
function sys_ajax_error(xhr, ajaxOptions, thrownError){
    console.log(xhr);
    console.log(ajaxOptions);
    console.log(thrownError);
    alert('頁面發生錯誤');
    sys_set_loading(false);

}
</script>
 