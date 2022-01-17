<?
  include(dirname(__dir__).'/include/baseclass.php');
?>
<meta charset="utf-8">
<title>臺北榮總健康管理中心</title>
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="css/home.css">
      
<?php /* <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>  */ ?>
<script type="text/javascript" src="js/jquery-3.4.1.js"></script>

<link type="text/css" rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>


  <link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
  <script src="lib/slick/slick.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).on('ready', function() {
      $(".regular").slick({
        dots: false,
		arrows: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
		autoplay: true,
        autoplaySpeed: 1500,
		responsive: [
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 641,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
      });
    });
  </script>      
