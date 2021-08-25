<?php class_exists('classes\Template') or exit; ?>
<?php  if (isset($_SESSION['user'])) : ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Boris Dmitrovic">
    <meta name="keywords"
          content="intership, news, backend">
    <meta name="description"
          content="News backend project for intership">
    <meta name="robots" content="noindex,nofollow">
    <title>Admin - <?php echo $title ?></title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/portal-back/assets/plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link href="/portal-back/assets/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<?php include_once "Views/components/preloader.php"?>

<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
     data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

    <?php  include_once "Views/components/header.php"?>

    <?php include_once "Views/components/left_sidebar.php"?>

    <div class="page-wrapper" style="min-height: 250px;">

        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div id="result" class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

<!--        <div id="result"></div>-->
            <?php echo $content ?>


        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <?php  include_once "Views/components/footer.php"?>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>

<?php  include_once "Views/components/script.php"?>
</body>

</html>
<?php
else : echo "You dont have permission";

endif;

?>


