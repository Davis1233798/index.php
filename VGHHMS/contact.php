<!DOCTYPE html>

<head>
    <?php include('layout/common.php');?>
</head>

<body class="grey">
    <?php include('layout/menu.php');?>
    <img src="images/top/contactbanner.png" class="img-responsive">

    <div class="wrapper">
        <div class="container">
            <div class="home-title">聯絡我們<span class="border"></span></div>
            <p class="home-subtitle">親愛的貴賓您好，您可簡述您的疑問，服務人員將盡快與您聯繫，謝謝。<br>因服務電話使用量大，建議善用網站連絡我們</p>
            <ul class="contact">
                <li><input type="text" id="txt_regname" placeholder="姓名" maxlength="50"></li>
                <li>性別： <label><input name="rd_sex" type="radio" value="1" checked />男</label> <label><input name="rd_sex" type="radio" value="0" />女</label></li>
                <li><input type="text" id="txt_tel1" placeholder="電話(H)" maxlength="20"></li>
                <li><input type="text" id="txt_tel2" placeholder="電話(O)" maxlength="20"></li>
                <li><input type="text" id="txt_mob" placeholder="行動電話" maxlength="20"></li>
                <li><input type="text" id="txt_email" placeholder="電子郵件" maxlength="50"></li>
                <li><textarea id="txt_Remark" placeholder="留言內容"></textarea></li>
                <li><input type="text" id="txt_confirm" placeholder="驗證碼"></li>
                <li><img src="<? echo $_env["site_url"]; ?>include/confirmcode.php?p=contact"></li>
                <li><input type="submit" value="確定" onclick="send_contact()"></li>
            </ul>

        </div>
        <div class="container inner">
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4295.917486356378!2d121.51998194732982!3d25.121433033853247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442ae8a02baaaab%
3A0x61b53cf6dbcd6e93!2z6Ie65YyX5qau5rCR57i96Yar6Zmi!5e0!3m2!1szh-TW!2stw!4v1535525444092"
                    width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>


    <?php include('layout/footer.php');?>

</body>
</html>
<script>

    function send_contact(){

        sys_set_loading(true);
        $.ajax({
            type: "POST",
            url: "include/ajax.php",
            data: {
                "fn": "contact",
                "regname": $("#txt_regname").val(),
                "sex": $("input[name='rd_sex']:checked").val(),
                "tel1": $("#txt_tel1").val(),
                "tel2": $("#txt_tel2").val(),
                "mob": $("#txt_mob").val(),
                "email": $("#txt_email").val(),
                "Remark": $("#txt_Remark").val(),
                "confirm": $("#txt_confirm").val(),
            },
            success:function(result){
                if(result.ok=='t'){
                    alert('您的留言已送出，我們將盡速與您聯絡。');
                    location.replace('./contact.php');
                } else {
                    alert(result.msg);
                }
                sys_set_loading(false);
            },
            error:function(xhr, ajaxOptions, thrownError){
                sys_ajax_error(xhr, ajaxOptions, thrownError);
            },
            datatype:"json"
        });
    }
</script>
</body>

</html>