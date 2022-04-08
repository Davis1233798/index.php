<script>
    $(function(){
        $(".menu > li").hover(function(){
            $(this).children(".submenu").stop().slideToggle(200);
        });
        $(".rwd_menu_btn").click(function(){
            $(this).toggleClass('open');
            $(".rwd_menu").slideToggle(300);
            $("body").toggleClass('hidden');
        });
        $(".rwd_menu li").click(function(){
            $(this).next(".rwd_submenu").slideToggle(300);
            //$(this).addClass('open').siblings(".rwd_menu li").removeClass('open');
            //$(this).next(".rwd_submenu").slideDown(300).siblings(".rwd_submenu").slideUp(300);
        });
    });
</script>
<div class="topmenu">
    <div class="container">
        <div class="logo"><a href="index.php" title="臺北榮總健康管理中心"><img src="images/logo.jpg" class="img-responsive"></a></div>

        <ul class="menu">

            <li style="width:95px">
                <a href="news.php">最新訊息</a>
            </li>
            <li style="width:95px">
                <a href="#">關於我們</a>
                <ul class="submenu">
                    <li><a href="info.php">我們的特色</a></li>
                    <li><a href="team.php">服務團隊</a></li>
                    <!--<li><a href="organization.php">組織架構</a></li>--->
                </ul>
            </li>
            <li style="width:125px">
                <a href="#">健檢項目/價格</a>
                <ul class="submenu">
                    <li><a href="c01.php">健檢組套</a></li>
                    <li><a href="d01.php">其他自費加選項目</a></li>
                </ul>
            </li>
            <li style="width:95px">
                <a href="reserve.php">網路預約</a>
            </li>
            <li style="width:95px">
                <a href="qa.php">常見問題</a>
            </li>
            <li style="width:95px">
                <a href="health.php">檢前飲食</a>
            </li>
            <li style="width:95px">
                <a href="contact.php">聯絡我們</a>
            </li>
            <li style="width:95px">
                <a href="#">勞工問卷</a>
                <ul class="submenu">
                    <li><a href="survey_pb.php">鉛作業問卷</a></li>
                    <li><a href="survey_dust.php">粉塵作業問卷</a></li>
                    <li><a href="survey_Hoco.php">甲醛作業問卷</a></li>
                    <li><a href="survey_radiation.php">游離作業問卷</a></li>
                </ul>
            </li>
            <li style="width:95px">
                <a href="#">ENGLISH</a>
                <ul class="submenu">
                    <li><a href="news_en.php">NEWS</a></li>
                    <li><a href="info_en.php">ABOUT US</a></li>
                    <li><a href="check_en.php">Health Checkup</a></li>
                </ul>
            </li>
            <div class="clear"></div>
        </ul>
        <div class="tel"><a href="contact.php"><img src="images/tel.png" class="img-responsive"></a></div>
    </div>

    <!--end menu-->
    <div class="clear"></div>

    <h1 class="rwdlogo"><a href="index.php" title="臺北榮總健康管理中心">臺北榮總健康管理中心</a></h1>
    <div class="rwd_menu_btn"><span></span></div>
    <ul class="rwd_menu" style="height:510px">
        <li><a href="news.php">最新訊息</a></li>
        <li><a href="#">關於我們</a></li>
        <ul class="rwd_submenu">
            <li><a href="info.php">我們的特色</a></li>
            <li><a href="team.php">服務團隊</a></li>
        </ul>
        <li><a href="#">健檢項目/價格</a></li>
        <ul class="rwd_submenu">
            <li><a href="c01.php">健檢組套</a></li>
            <li><a href="d01.php">其他自費加選項目</a></li>
        </ul>
        <li><a href="reserve.php">網路預約</a></li>
        <li><a href="qa.php">常見問題</a></li>
        <li><a href="health.php">檢前飲食</a></li>
        <li><a href="contact.php">聯絡我們</a></li>
        <li><a href="#">ENGLISH</a></li>
        <ul class="rwd_submenu">
            <li><a href="news_en.php">NEWS</a></li>
            <li><a href="info_en.php">ABOUT US</a></li>
            <li><a href="check_en.php">Health Checkup</a></li>
        </ul>
        <div class="clear"></div>
    </ul>
</div>
<!--end top-->
<!--end rwd_menu-->
