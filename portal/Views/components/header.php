
<header id="header">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="header_top">
                <div class="header_top_left">
                    <ul class="top_nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="contact">Contact</a></li>
                    </ul>
                </div>
                <div class="header_top_right">

                    <?php  if (!isset($_SESSION['user'])) : ?>
                    <p >  <a href="login-form" style="color: white">Login</a> /
                        <a href="register-form" style="color: white">Register</a> </p>
                    <?php else : ?>
                        <p><a href="logout" style="color: white">Logout</a> </p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="header_bottom">
                <div class="logo_area"><a href="index.php" class="logo"><img src="images/logo.jpg" alt=""></a></div>
            </div>
        </div>
    </div>
</header>