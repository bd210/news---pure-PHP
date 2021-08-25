<!DOCTYPE html>
<html lang="en">
<head>
    <title> NewsFeed - {{ $title }} </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="news application for intership">
    <meta name="keywords" content="news, application, intership">
    <meta name="author" content="Boris Dmitrovic">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/portal/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/portal/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/portal/assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/portal/assets/css/font.css">
    <link rel="stylesheet" type="text/css" href="/portal/assets/css/li-scroller.css">
    <link rel="stylesheet" type="text/css" href="/portal/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/portal/assets/css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="/portal/assets/css/theme.css">
    <link rel="stylesheet" type="text/css" href="/portal/assets/css/style.css">
    <!--[if lt IE 9]>

    <script src="/portal/assets/js/html5shiv.min.js"></script>
    <script src="/portal/assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!--<div id="preloader">-->
<!--  <div id="status">&nbsp;</div>-->
<!--</div>-->
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
    <?php include_once "Views/components/header.php"?>
    <?php include_once "Views/components/navigation.php"?>
    <?php include_once "Views/components/track.php"?>

        {{ $content }}

    <?php  include_once "Views/components/footer.php"?>
</div>
<script src="/portal/assets/js/jquery.min.js"></script>
<script src="/portal/assets/js/wow.min.js"></script>
<script src="/portal/assets/js/bootstrap.min.js"></script>
<script src="/portal/assets/js/slick.min.js"></script>
<script src="/portal/assets/js/jquery.li-scroller.1.0.js"></script>
<script src="/portal/assets/js/jquery.newsTicker.min.js"></script>
<script src="/portal/assets/js/jquery.fancybox.pack.js"></script>
<script src="/portal/assets/js/custom.js"></script>


</body>
</html>